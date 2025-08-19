@extends('layouts.app')
@section('title','Checkout')
@section('content')
<div class="row">
  <div class="col-md-7">
    <div class="card shadow rounded-2xl"><div class="card-body">
      <h5>Ringkasan</h5>
      <table class="table table-sm">
        <thead><tr><th>Produk</th><th>Qty</th><th>Subtotal</th></tr></thead>
        <tbody>
          @php $subtotal=0; @endphp
          @foreach($cart as $it) @php $subtotal += $it['price']*$it['qty']; @endphp
          <tr><td>{{ $it['name'] }}</td><td>{{ $it['qty'] }}</td><td>Rp {{ number_format($it['price']*$it['qty'],0,',','.') }}</td></tr>
          @endforeach
        </tbody>
        <tfoot><tr><th colspan="2" class="text-right">Total</th><th>Rp {{ number_format($subtotal,0,',','.') }}</th></tr></tfoot>
      </table>
    </div></div>
  </div>
  <div class="col-md-5">
    <div class="card shadow rounded-2xl"><div class="card-body">
      <form method="post" action="{{ route('shop.process') }}">@csrf
        <div class="form-group"><label>Nama</label><input name="name" class="form-control" required></div>
        <div class="form-group"><label>No. HP</label><input name="phone" class="form-control" required></div>
        <div class="form-group"><label>Email (opsional)</label><input name="email" type="email" class="form-control"></div>
        <button class="btn btn-primary btn-block">Buat Pesanan</button>
      </form>
    </div></div>
  </div>
</div>
@endsection
