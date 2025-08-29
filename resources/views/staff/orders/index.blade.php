@extends('layouts.app')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    <h3>Pesanan Online</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="width:100%" id="tbl">
            <thead><tr><th>ID</th><th>Invoice</th><th>Pelanggan</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($orders as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ optional($o->customer)->name }}</td>
                    <td>Rp {{ number_format($o->total,0,',','.') }}</td>
                    <td>{{ $o->status }}</td>
                    <td>
                        @if($o->status=='pending')
                        <button class="btn btn-success btn-confirm" data-id="{{ $o->id }}">Konfirmasi</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Modal Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-2xl shadow">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Metode Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body text-center">
        <input type="hidden" id="order_id">
        <div class="mb-3">
          <button class="btn btn-primary w-100 mb-2" id="payCash">💵 Bayar Cash</button>
          <button class="btn btn-warning w-100" id="payQris">📱 Bayar QRIS</button>
      </div>
      <div id="qrisBox" class="d-none">
          <h6>Scan QRIS untuk bayar:</h6>
          <img id="qrisImg" src="" alt="QRIS" class="img-fluid">
          <p id="qrisMsg" class="mt-2 text-muted">Menunggu pembayaran...</p>
      </div>
  </div>
</div>
</div>
</div>
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        let selectedOrder = null;

    // klik konfirmasi → tampilkan modal
        document.querySelectorAll('.btn-confirm').forEach(btn=>{
            btn.addEventListener('click', function(){
                selectedOrder = btn.dataset.id;
                document.getElementById('order_id').value = selectedOrder;
                var modal = new bootstrap.Modal(document.getElementById('paymentModal'));
                modal.show();
            });
        });

    // Bayar Cash
        document.getElementById('payCash').addEventListener('click', function(){
            if(!confirm('Yakin konfirmasi bayar CASH?')) return;
            fetch(`/staff/orders/${selectedOrder}/confirm-cash`, {
                method:'POST',
                headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
            }).then(r=>r.json()).then(js=>{
                alert(js.message);
                location.reload();
            });
        });

    // Klik Bayar QRIS        
        document.getElementById('payQris').addEventListener('click', function() {
            let orderId = document.getElementById('order_id').value;

            fetch("{{ route('payment.snap') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ order_id: orderId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.token) {
            // Munculkan Snap Midtrans
                    snap.pay(data.token, {
                        onSuccess: function(result){
                            console.log("success", result);
                            alert("Pembayaran berhasil!");
                            location.reload();
                        },
                        onPending: function(result){
                            console.log("pending", result);
                            alert("Menunggu pembayaran...");
                        },
                        onError: function(result){
                            console.error("error", result);
                            alert("Pembayaran gagal!");
                        },
                        onClose: function(){
                            alert("Anda menutup popup sebelum menyelesaikan pembayaran");
                        }
                    });
                }
            });
        });

    });
</script>

@endsection
