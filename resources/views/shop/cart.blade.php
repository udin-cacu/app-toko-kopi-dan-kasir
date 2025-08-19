@include('shop.layouts.header')
<style>
  #customers {
    border-collapse: collapse;
    width: 100%;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 12px 8px 12px 8px;
    font-size: 11px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #ff9500;
    color: white;
  }

  .nav2 {
    position: fixed;
    bottom: 0;
    left: 15px;
    background-color: #ff9500;
    display: flex;
    overflow-x: auto;

    margin-bottom: 20px;
    border-radius: 3rem;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
    height: 55px;
    width: 55px;
    border-color: whitesmoke;
  }

  #profile { overflow-y:scroll }

  @media (max-width: 576px) {
    .table td, .table th {
      padding: 6px;
    }
    .table input {
      font-size: 12px;
    }
  }


</style>

<div class="card shadow rounded-2xl">
  <div class="card-body p-2" style="overflow-x:auto;">
    @php $cart = $cart ?? []; @endphp
    @if(empty($cart))
    <p>Keranjang kosong. <a href="{{ route('shop.menu') }}"><span class="badge badge-primary">Belanja sekarang</span></a></p>
    @else
    <div class="table-responsive">
      <table class="table table-bordered table-sm mb-0" style="font-size: 12px; word-break: break-word;">
        <thead class="thead-light">
          <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php $subtotal=0; @endphp
          @foreach($cart as $it)
          @php $subtotal += $it['price'] * $it['qty']; @endphp
          <tr>
            <td>{{ $it['name'] }}</td>
            <td>Rp {{ number_format($it['price'],0,',','.') }}</td>
            <td style="width: 110px; padding: 2px;">
              <input type="number" 
              value="{{ $it['qty'] }}" 
              min="1" 
              class="form-control form-control-sm text-center" 
              style="min-width: 60px; padding: 2px 4px; height: 28px; font-size: 12px;"
              onchange="updateQty({{ $it['id'] }}, this.value)">
            </td>

            <td id="total-{{ $it['id'] }}">Rp {{ number_format($it['price']*$it['qty'],0,',','.') }}</td>

            <td>
              <button class="btn btn-sm btn-danger" onclick="removeItem({{ $it['id'] }})">
                Hapus
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-right">Subtotal</th>
            <th colspan="2" id="subtotal">Rp {{ number_format($subtotal,0,',','.') }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="text-right mt-2">
      <a href="{{ route('shop.checkout') }}" class="btn btn-sm btn-success">Checkout</a>
    </div>
    @endif
  </div>
</div>


</div>
</div>
@include('shop.layouts.footer')
<script type="text/javascript">
        /*function updateQty(id, qty){
          $.post('{{ route('shop.update') }}',{_token:'{{ csrf_token() }}', product_id:id, qty:qty});
        }*/
  function removeItem(id){
    $.post('{{ route('shop.remove') }}',{_token:'{{ csrf_token() }}', product_id:id}).done(()=>location.reload());
  }

  function updateQty(id, qty){
    $.post('{{ route('shop.update') }}', {
      _token:'{{ csrf_token() }}', 
      product_id:id, 
      qty:qty
    }).done(() => location.reload());
  }


</script>

</body>

</html>