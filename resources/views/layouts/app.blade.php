<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name','Kopi POS') }}</title>
  <link href="{{ asset ('content/assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Icons -->
  <link href="{{ asset ('content/assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
  <link href="{{ asset ('content/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset ('content/assets/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset ('content/assets/css/loading.css') }}">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <style>.rounded-2xl{border-radius:1rem}</style>
  @stack('styles')
</head>
<body class="bg-default">
  <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-default">
    <div class="container">
      <a class="navbar-brand" href="{{ route('dashboard') }}">Kopi POS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbars">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="{{ route('shop.menu') }}" class="nav-link">Menu</a></li>
          <li class="nav-item"><a href="{{ route('shop.cart') }}" class="nav-link">Keranjang</a></li>
          @auth
          <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link">Kategori</a></li>
          <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Produk</a></li>
          <li class="nav-item"><a href="{{ route('customers.index') }}" class="nav-link">Pelanggan</a></li>
          <li class="nav-item"><a href="{{ route('pos') }}" class="nav-link">POS</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('staff.orders.index') }}">Pesanan Online</a></li>
          <li class="nav-item"><a href="{{ route('reports.sales') }}" class="nav-link">Laporan</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">{{ Auth::user()->name ?? 'User' }}</a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </div>
          </li>
          @else
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login Staff</a></li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <div class="header bg-gradient-primary py-5">
      <div class="container">
        <div class="header-body text-center mb-4">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
              <h1 class="text-white">@yield('title','Kopi POS')</h1>
              <p class="text-lead text-light">Sistem kasir sederhana untuk toko kopi.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      @yield('content')
    </div>
  </div>

  <script src="{{ asset ('content/assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset ('content/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--   Optional JS   -->
<script src="{{ asset ('content/assets/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset ('content/assets/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
<!--   Argon JS   -->
<script src="{{ asset ('content/assets/js/argon-dashboard.min.js?v=1.1.2') }}"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script><!-- Bootstrap JS (sesuai versi) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->

<script>
  window.TrackJS &&
  TrackJS.install({
    token: "ee6fab19c5a04ac1a32a645abde4613a",
    application: "argon-dashboard-free"
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script type="text/javascript">
  $('.menusxx').on('click', function () {

    $('.loading').attr('style','display: block');

  });
</script>
@stack('scripts')
</body>
</html>
