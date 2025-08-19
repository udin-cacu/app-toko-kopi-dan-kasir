@extends('layouts.app')
@section('title','Menu Kopi')
@section('content')
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
<div class="d-flex justify-content-between align-items-center mb-3">
  <form method="get" class="form-inline">
    <input type="text" name="q" class="form-control mr-2" value="{{ $q }}" placeholder="Cari menu...">
    <button class="btn btn-outline-primary">Cari</button>
  </form>
  <a href="{{ route('shop.cart') }}" class="btn btn-success">
    Keranjang <span class="badge badge-light">{{ array_sum(array_column($cart,'qty')) }}</span>
  </a>
</div>
<div class="row">
  @foreach($products as $p)
  <div class="col-md-4 mb-3">
    <div class="card shadow-sm h-100 rounded-2xl">
      <img class="card-img-top" src="{{ $p->photo ?? 'https://via.placeholder.com/640x360?text='.urlencode($p->name) }}" alt="{{ $p->name }}">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title mb-1">{{ $p->name }}</h5>
        <div class="text-muted mb-3">Rp {{ number_format($p->price,0,',','.') }}</div>
        <div class="mt-auto">
          <button class="btn btn-primary btn-block" onclick="addToCart({{ $p->id }})"><i class="fas fa-cart-plus"></i> Tambah</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@push('scripts')
<script>
  function addToCart(id){
    $.post('{{ route('shop.add') }}', {_token:'{{ csrf_token() }}', product_id:id}).done(res=>{
      alert('Ditambahkan ke keranjang');
    });
  }
</script>
@endpush
