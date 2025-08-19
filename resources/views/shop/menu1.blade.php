@extends('layouts.app')
@section('title','Menu Kopi')

@section('content')
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
  <form method="get" class="form-inline">
    <div class="input-group">
      <input type="text" name="q" class="form-control" value="{{ $q }}" placeholder="Cari menu...">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit"><i class="ni ni-zoom-split-in"></i> Cari</button>
      </div>
    </div>
  </form>
  <a href="{{ route('shop.cart') }}" class="btn btn-success btn-icon">
    <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
    <span class="btn-inner--text">Keranjang</span>
    <span class="badge badge-light ml-2">{{ array_sum(array_column($cart,'qty')) }}</span>
  </a>
</div>

<div class="row">
  @foreach($products as $p)
  <div class="col-md-4 mb-4">
    <div class="card shadow border-0 h-100 card-hover">
      <div class="card-img-top position-relative" style="overflow:hidden; height:200px;">
        <img src="{{ $p->photo ?? 'https://via.placeholder.com/640x360?text='.urlencode($p->name) }}" 
        alt="{{ $p->name }}" 
        class="img-fluid w-100 h-100" 
        style="object-fit:cover; transition: transform 0.3s ease-in-out;">
      </div>
      <div class="card-body d-flex flex-column">
        <h5 class="card-title font-weight-bold text-dark mb-1">{{ $p->name }}</h5>
        <p class="text-muted mb-3">Rp {{ number_format($p->price,0,',','.') }}</p>
        <div class="mt-auto">
          <button class="btn btn-primary btn-block" onclick="addToCart({{ $p->id }})">
            <i class="fas fa-cart-plus mr-1"></i> Tambah ke Keranjang
          </button>
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

// Efek hover untuk gambar
  document.querySelectorAll('.card-hover img').forEach(img => {
    img.addEventListener('mouseover', () => img.style.transform = 'scale(1.1)');
    img.addEventListener('mouseout', () => img.style.transform = 'scale(1)');
  });
</script>
@endpush
