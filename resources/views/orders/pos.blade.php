@extends('layouts.app')
@section('title','POS Kasir')
@section('content')
<div class="row">
  <div class="col-md-7">
    <div class="card shadow rounded-2xl"><div class="card-body">
      <div class="form-group">
        <input id="search" class="form-control" placeholder="Cari produk (min 1 huruf)…" />
      </div>
      <div id="result" class="list-group" style="max-height:260px;overflow:auto"></div>
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered" id="cart">
          <thead><tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Total</th><th></th></tr></thead>
          <tbody></tbody>
          <tfoot><tr><th colspan=3 class="text-right">Subtotal</th><th id="subtotal">0</th><th></th></tr></tfoot>
        </table>
      </div>
    </div></div>
  </div>
  <div class="col-md-5">
    <div class="card shadow rounded-2xl"><div class="card-body">
      <div class="form-group">
        <label>Pelanggan</label>
        <select id="customer_id" class="form-control">
          <option value="">Umum</option>
          @foreach($customers as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group"><label>Diskon</label><input id="discount" type="number" class="form-control" value="0"></div>
      <div class="form-group"><label>Pajak</label><input id="tax" type="number" class="form-control" value="0"></div>
      <div class="form-group"><label>Bayar</label><input id="paid" type="number" class="form-control" value="0"></div>
      <div class="form-group"><label>Metode</label>
        <select id="method" class="form-control">
          <option>cash</option><option>qris</option><option>edc</option>
        </select>
      </div>
      <button id="btnPay" class="btn btn-success btn-block">Bayar</button>
      <div id="info" class="mt-3 text-center"></div>
    </div></div>
  </div>
</div>
@endsection

@push('scripts')
<script>
const cart = [];
function render(){
  const tbody = $('#cart tbody'); tbody.empty();
  let subtotal = 0;
  cart.forEach((it,i)=>{
    const row = $(`<tr>
      <td>${it.name}</td>
      <td>Rp ${Number(it.price).toLocaleString('id-ID')}</td>
      <td><input type='number' class='form-control form-control-sm' value='${it.qty}' min='1' style='width:80px'></td>
      <td>Rp ${(it.price*it.qty).toLocaleString('id-ID')}</td>
      <td><button class='btn btn-sm btn-danger'>X</button></td>
    </tr>`);
    row.find('input').on('change', function(){ it.qty = parseInt(this.value||1); render(); });
    row.find('button').on('click', function(){ cart.splice(i,1); render(); });
    tbody.append(row);
    subtotal += it.price*it.qty;
  });
  $('#subtotal').text('Rp '+subtotal.toLocaleString('id-ID'))
}

$('#search').on('keyup', function(){
  const q = this.value.trim(); if(!q) return $('#result').empty();
  $.get("{{ route('pos.search') }}", {q}).done(rows=>{
    const res = $('#result'); res.empty();
    rows.forEach(r=>{
      const item = $(`<a href='#' class='list-group-item list-group-item-action'>${r.name} · <small>${r.category}</small> <span class='float-right'>Rp ${Number(r.price).toLocaleString('id-ID')}</span></a>`)
        .on('click', function(e){ e.preventDefault();
          const exist = cart.find(x=>x.id===r.id);
          if(exist) exist.qty++; else cart.push({id:r.id, name:r.name, price:Number(r.price), qty:1});
          render();
        });
      res.append(item);
    })
  })
});

$('#btnPay').on('click', function(){
  if(!cart.length) return alert('Keranjang kosong');
  const payload = {
    _token: '{{ csrf_token() }}',
    customer_id: $('#customer_id').val(),
    items: cart.map(x=>({id:x.id,qty:x.qty,price:x.price})),
    discount: Number($('#discount').val()||0),
    tax: Number($('#tax').val()||0),
    paid: Number($('#paid').val()||0),
    method: $('#method').val()
  };
  $.post("{{ route('pos.store') }}", payload).done(res=>{
    $('#info').html(`<div class='alert alert-success'>Berhasil! Invoice: <b>${res.invoice}</b><br>Kembalian: Rp ${Number(res.change).toLocaleString('id-ID')}</div>`);
    cart.length = 0; render();
  }).fail(err=>{
    alert('Gagal simpan');
  })
});
</script>
@endpush
