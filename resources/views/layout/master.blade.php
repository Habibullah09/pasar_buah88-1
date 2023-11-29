<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pasar Buah 88</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('asset/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('asset/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('asset/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('asset/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('asset/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('asset/js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('asset/css/vertical-layout-light/style.css')}}">
  
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('asset/images/88icon.png')}}" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{asset('asset/images/logo88.png')}}" class="mr-2" alt="logo" width="100%"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <span class="mr-2 d-none d-lg-inline text-gray-600">{{auth()->user()->role}}</span>
            <a class="nav-link dropdown-toggle" href="/logout" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('asset/images/profil.png')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="/logout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(auth()->user()->role == 'Staff Lapangan')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/order') }}">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Order Barang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/mutasi') }}">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Mutasi Lapangan</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->role == 'Staff Gudang')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/mutasi') }}">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Mutasi Gudang</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->role == 'Staff Gudang' || auth()->user()->role == 'Staff Lapangan')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/terimaMutasi') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Terima Mutasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/stok_barang') }}">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Stok Barang</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/akun') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Akun</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      @yield('content')
      <!-- main-panel ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('asset/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('asset/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('asset/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('asset/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('asset/js/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('asset/js/off-canvas.js')}}"></script>
  <script src="{{asset('asset/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('asset/js/template.js')}}"></script>
  <script src="{{asset('asset/js/settings.js')}}"></script>
  <script src="{{asset('asset/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('asset/js/dashboard.js')}}"></script>
  <script src="{{asset('asset/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->
</body>

</html>

