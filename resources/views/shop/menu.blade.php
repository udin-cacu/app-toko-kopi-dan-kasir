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

</style>

<div class="row">
  <div class="col-6">
    <form method="get" class="form-inline">
      <div class="input-group input-group-sm">
        <input type="text" name="q" class="form-control form-control-sm" value="{{ $q }}" placeholder="Cari menu...">
        <div class="input-group-append">
          <button class="btn btn-primary btn-sm" type="submit">
            <i class="ni ni-zoom-split-in"></i> Cari
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-6">
    <a href="{{ route('shop.cart') }}" class="btn btn-success btn-sm btn-icon">
      <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
      <span class="btn-inner--text">Keranjang</span>
      <span class="badge badge-light ml-2">{{ array_sum(array_column($cart,'qty')) }}</span>
    </a>
  </div>
</div>

<hr>

<div class="row">
  @foreach($products as $p)
  <div class="col-sm-6 col-6 mb-3">
    <div class="card shadow" style="border-radius: 2rem;">
      <div class="card-img-top text-center p-2">
        <img src="/assets/img_foto/kopi.png" 
        alt="{{ $p->name }}" 
        class="img-fluid"
        style="width:80px; height:auto; display:block; margin:auto;">
      </div>
      <div class="card-body d-flex flex-column text-center">
        <h6 class="card-title font-weight-bold text-dark mb-1" style="font-size:14px;">
          {{ $p->name }}
        </h6>
        <p class="text-muted mb-3" style="font-size:13px;">
          Rp {{ number_format($p->price,0,',','.') }}
        </p>
        <div class="mt-auto">
          <button class="btn btn-sm btn-primary btn-block" onclick="addToCart({{ $p->id }})">
            <i class="fas fa-cart-plus mr-1"></i> Tambah
          </button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>


          <!-- <div style="font-size:15px;">
            <b>
              Transaksi Anda :
            </b>
          </div>
        </div>

        <div class="row" style="margin-left: 0px;margin-right:0px;">
          <div class="col-12">
            <div class="card shadow-ss" style="border-radius: 1rem;margin-top:10px;">
              <div class="card-body" align="center">
                <img src="/assets/content/img/theme/dealempty.jpg" width="80%">
                <div style="padding-top: 12px;">Tidak ada Transaksi Apapun Saat ini!</div>
              </div>
            </div>
          </div>
        </div> -->

      </div>
    </div>
    @include('shop.layouts.footer')
    <script type="text/javascript">
      function addToCart(id) {
        $.post('{{ route('shop.add') }}', {
          _token: '{{ csrf_token() }}',
          product_id: id
        })
        .done(function(res) {
          alert('Ditambahkan ke keranjang');
        })
        .fail(function(xhr) {
          console.error(xhr.responseText);
          alert('Gagal menambahkan ke keranjang');
        });
      }

    </script>

  </body>

  </html>