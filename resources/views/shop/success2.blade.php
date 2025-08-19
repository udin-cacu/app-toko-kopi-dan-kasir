@extends('layouts.app')
@section('title','Pesanan Dibuat')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body text-center">
    <h3>Terima kasih!</h3>
    <p>Pesanan kamu sudah dibuat dengan nomor <b>{{ $order->invoice }}</b>.</p>
    <p>Tunjukkan nomor ini saat pengambilan. Status saat ini: <span class="badge badge-warning text-uppercase">{{ $order->status }}</span></p>
    <a href="{{ route('shop.menu') }}" class="btn btn-outline-primary mt-3">Kembali ke Menu</a>
  </div>
</div>
@endsection
