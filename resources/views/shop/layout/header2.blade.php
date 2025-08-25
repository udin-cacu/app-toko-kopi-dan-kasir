<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coffee - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

  <link rel="stylesheet" href="/assets2/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="/assets2/css/animate.css">

  <link rel="stylesheet" href="/assets2/css/owl.carousel.min.css">
  <link rel="stylesheet" href="/assets2/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="/assets2/css/magnific-popup.css">

  <link rel="stylesheet" href="/assets2/css/aos.css">

  <link rel="stylesheet" href="/assets2/css/ionicons.min.css">

  <link rel="stylesheet" href="/assets2/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="/assets2/css/jquery.timepicker.css">


  <link rel="stylesheet" href="/assets2/css/flaticon.css">
  <link rel="stylesheet" href="/assets2/css/icomoon.css">
  <link rel="stylesheet" href="/assets2/css/style.css">
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
   <div class="container">
     <a class="navbar-brand" href="index.html">Coffee<small>Blend</small></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="oi oi-menu"></span> Menu
     </button>
     <div class="collapse navbar-collapse" id="ftco-nav">
       <ul class="navbar-nav ml-auto">
         <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item {{ Request::is('menu2') ? 'active' : '' }}">
          <a href="/menu2" class="nav-link">Menu</a>
        </li>
        <li class="nav-item {{ Request::is('services') ? 'active' : '' }}">
          <a href="/services" class="nav-link">Services</a>
        </li>
        <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
          <a href="/about" class="nav-link">About</a>
        </li>
        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
          <a href="/login" class="nav-link">Login</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
    <!-- END nav -->