@extends('layouts.app')
@section('title','Keranjang Belanja')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    @php $cart = $cart ?? []; @endphp
    @if(empty($cart))
      <p>Keranjang kosong. <a href="{{ route('shop.menu') }}">Belanja sekarang</a></p>
    @else
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead><tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Total</th><th></th></tr></thead>
        <tbody>
          @php $subtotal=0; @endphp
          @foreach($cart as $it)
          @php $subtotal += $it['price'] * $it['qty']; @endphp
          <tr>
            <td>{{ $it['name'] }}</td>
            <td>Rp {{ number_format($it['price'],0,',','.') }}</td>
            <td style="width:120px">
              <input type="number" value="{{ $it['qty'] }}" min="1" class="form-control form-control-sm" onchange="updateQty({{ $it['id'] }}, this.value)">
            </td>
            <td>Rp {{ number_format($it['price']*$it['qty'],0,',','.') }}</td>
            <td><button class="btn btn-sm btn-danger" onclick="removeItem({{ $it['id'] }})">Hapus</button></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot><tr><th colspan="3" class="text-right">Subtotal</th><th colspan="2">Rp {{ number_format($subtotal,0,',','.') }}</th></tr></tfoot>
      </table>
    </div>
    <div class="text-right">
      <a href="{{ route('shop.checkout') }}" class="btn btn-success">Checkout</a>
    </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  function updateQty(id, qty){
    $.post('{{ route('shop.update') }}',{_token:'{{ csrf_token() }}', product_id:id, qty:qty});
  }
  function removeItem(id){
    $.post('{{ route('shop.remove') }}',{_token:'{{ csrf_token() }}', product_id:id}).done(()=>location.reload());
  }
</script>
@endpush
