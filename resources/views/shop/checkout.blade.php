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