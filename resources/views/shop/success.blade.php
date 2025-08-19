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
  <div class="card-body text-center">
    <h3>Terima kasih!</h3>
    <p>Pesanan kamu sudah dibuat dengan nomor <b>{{ $order->invoice }}</b>.</p>
    <p>Tunjukkan nomor ini saat pengambilan. Status saat ini: <span class="badge badge-warning text-uppercase">{{ $order->status }}</span></p>
    <a href="{{ route('shop.menu') }}" class="btn btn-outline-primary mt-3">Kembali ke Menu</a>
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