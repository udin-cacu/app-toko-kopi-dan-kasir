
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme_color" content="#ffffff">   
  <meta name="google-site-verification" content="QQlFHuHFdZ-Lo_AjAaYiJCElYinurhfwQiBVsEG5Xjc" />
  <title>APP TOKO KOPI</title>
  <!-- Favicon -->
  <link href="/assets/icon/72x72.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Icons -->
  <link href="/assets/content/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/content/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="/assets/splash/vendor/select2/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="/assets/content/css/loading.css">
  <!-- CSS Files -->
  <link href="/assets/content/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <link href="{{ asset ('assets/content/css/nav-footer.css') }}" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

  <link rel="manifest" href="/manifest.json">

  <!-- ios support -->
  <link rel="apple-touch-icon" href="/assets/icon/96x96.png">
  <meta name="apple-mobile-web-app-status-bar" content="#aa7700">

</head>
<style type="text/css">

  .swal-modal .swal-text {
    text-align: center;
  }

  
</style>
<body class="">
  <nav style="top: 0;width: 100%;z-index: 100;" class="navbar navbar-vertical navbar-expand-md navbar-light bg-survey" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      {{ csrf_field() }}
      <a class="navbar-brand pt-0" href="/" style="color: white; font-size: 18px;">
        <div style="font-size: 24px;font-weight:bold;">TOKO KOPI</div>
      </a>
      
      <div align="right">
        <button class="navbar-toggler " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span style="color: white;" class="fa fa-bars"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">

          <a href="{{ route('shop.menu') }}" class="nav-link"><span style="color: #8898aa;" class="fa fa-list"></span> Menu</a>
          <a href="{{ route('shop.cart') }}" class="nav-link"><span style="color: #8898aa;" class="fa fa-shopping-cart"></span> Keranjang</a>
          <hr>
          <a href="{{ route('login') }}" class="nav-link"> <span style="color: #8898aa;" class="fa fa-key"></span> Login Staff</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
      <div class="loading" style="display: none;">Loading&#8230;</div>
    </div>
  </nav>

  <!-- Content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-absen pt-3 pt-md-8" style="padding-bottom: 8rem;">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <!-- <a href="javascript: window.history.go(-1)"><button type="button" id="back" class='btn btn-sm btn-success'>Kembali</button></a> -->
        </div>
      </div>
    </div>
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-12" style="padding-bottom: 25px;">
          <div style="font-size: 18px" class="text-white"><b>
            Toko Kopi Kita
          </b> 
        </div>

        <div style="font-size: 11px" class="text-white"><i class="fa fa-location-arrow" style="color: white;"></i> Cabang Gempol</div>
      </div>
      <br>
      <div class="col-xl-4 order-xl-2 mb-xl-0" style="padding-right: 0px;padding-left: 0px;">
        <div class="card" style="border-radius: 2rem;border: 0px;background-color:#fff7eb;">
          <div class="card-body" style="padding: 1rem; height: 100%">

            <div class="card-body bg-survey shadow-ss" style="border-radius: 1rem;padding: 0.5rem 0.5rem 0.5rem 1rem;">
              <table width="100%">
                <tr>
                  <td align="left" width="40%">
                    <div style="color: white;">
                      <table width="100%">
                        <tr>
                          <td width="25%">
                            <i class="fa fa-coins" style="width:75%;color: white;font-size: 150%;"></i>
                          </td>
                          <td>
                            <a href='/poin/detail' style="color: white;">
                              <div style="font-size:10px;">Promo Hari Ini :</div>
                              <b style="font-size: 13px;">

                                Rp. 10000
                              </b>
                            </a>
                          </td>
                        </tr>
                      </table>

                    </div>
                  </td>
                  <td width="20%">&nbsp;</td>
                  <td align="left" width="40%">
                    <div style="color: white;">
                      <table width="100%">
                        <tr>
                          <td width="25%">
                            <i class="fa fa-credit-card" style="width:75%;color: white;font-size: 150%;"></i>
                          </td>
                          <td>
                            <a href='/undian' style="color: white;">
                              <div style="font-size:10px;">Kupon Kopi :</div>
                              <b style="font-size: 13px;">100</b>
                            </a>
                          </td>
                        </tr>
                      </table>

                    </div>
                  </td>
                </tr>
              </table>
            </div>

            <hr>