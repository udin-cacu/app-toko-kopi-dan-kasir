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

<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.btn-confirm').forEach(btn=>{
            btn.addEventListener('click', function(){
                if(!confirm('Konfirmasi pesanan?')) return;
                fetch('/staff/orders/' + btn.dataset.id + '/confirm', { method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' } })
                .then(r=>r.json()).then(js=>{ alert(js.message); location.reload(); });
            });
        });
    });
</script>
@endsection
