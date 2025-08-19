@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card shadow rounded-2xl">
      <div class="card-body">
        <h5 class="card-title">Penjualan Hari Ini</h5>
        <h2 class="mb-0">Rp {{ number_format($sales->total ?? 0,0,',','.') }}</h2>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow rounded-2xl"><div class="card-body">
      <h5 class="card-title">Transaksi Hari Ini</h5>
      <h2 class="mb-0">{{ $countOrders }}</h2>
    </div></div>
  </div>
</div>

<div class="card shadow mt-4 rounded-2xl">
  <div class="card-header"><strong>Top Produk</strong></div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped mb-0">
        <thead><tr><th>#</th><th>Produk</th><th>Qty</th></tr></thead>
        <tbody>
          @foreach($topProducts as $i=>$p)
          <tr><td>{{ $i+1 }}</td><td>{{ $p->name }}</td><td>{{ $p->qty }}</td></tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
