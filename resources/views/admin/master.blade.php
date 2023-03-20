<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>UPTD-BLK Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/template/assets/images/karawang-logo.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('/template/assets/libs/flot/css/float-chart.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('/template/dist/css/style.min.css')}}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="/paketpelatihan">
                        <b class="logo-icon ps-2">
                            <img style="height: 30px;" src="{{ asset('/template/assets/images/karawang-logo.png') }}" alt="homepage" class="light-logo" />
                        </b>
                        <span class="logo-text">
                            <h6 class="mt-3">UPTD BLK KARAWANG</h6>
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span
                                    class="hide-menu">My Profile </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @if (Auth::user()->role == 'superadmin')
                                    <li class="sidebar-item"><a href="/pegawai" class="sidebar-link"><i></i><span class="hide-menu">Data Pegawai</span></a></li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('logout') }}" class="sidebar-link"
                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                            <i></i><span class="hide-menu"> Logout</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                            @csrf
                                        </form>
                                        </li>
                                    </li>
                                @elseif (Auth::user()->role == 'admin')
                                    <li class="sidebar-item"><a href="/profile" class="sidebar-link"><i></i><span class="hide-menu"> My Profile</span></a></li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('logout') }}" class="sidebar-link"
                                            onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                                                <i></i><span class="hide-menu"> Logout</span>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                                @csrf
                                            </form>
                                            </li>
                                        </li>
                                @endif

                            </ul>
                        </li>
                        @if (Auth::user()->role == 'superadmin')
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                    href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-table"></i><span
                                        class="hide-menu">NMN </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="/kejuruan" class="sidebar-link"><i></i><span class="hide-menu"> Kejuruan</span></a></li>
                                    <li class="sidebar-item"><a href="/subkejuruan" class="sidebar-link"><i></i><span class="hide-menu"> Subkejuruan</span></a></li>
                                    <li class="sidebar-item"><a href="/dana" class="sidebar-link"><i></i><span class="hide-menu"> Dana</span></a></li>
                                    <li class="sidebar-item"><a href="/jpelatihan" class="sidebar-link"><i></i><span class="hide-menu"> Jenis Pelatihan</span></a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-archive"></i><span
                                class="hide-menu">Pelatihan </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="/skkni" class="sidebar-link"><i></i><span class="hide-menu"> SKKNI/Silabus</span></a></li>
                            <li class="sidebar-item"><a href="/paketpelatihan" class="sidebar-link"><i></i><span class="hide-menu"> Paket Pelatihan</span></a></li>
                        </ul>
                        @if (Auth::user()->role == 'superadmin')

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span
                                    class="hide-menu">Data </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="/pendaftaran" class="sidebar-link"><i></i><span class="hide-menu"> Pendaftaran</span></a></li>
                                <li class="sidebar-item"><a href="/bukuinduk" class="sidebar-link"><i></i><span class="hide-menu"> Buku Induk</span></a></li>
                                <li class="sidebar-item"><a href="/alumni" class="sidebar-link"><i></i><span class="hide-menu"> Alumni</span></a></li>
                                <li class="sidebar-item"><a href="/riwayat" class="sidebar-link"><i></i><span class="hide-menu"> Riwayat Pendaftaran</span></a></li>
                            </ul>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/pengumuman" aria-expanded="false"><i class="mdi mdi-presentation"></i><span
                                    class="hide-menu">Pengumuman</span></a></li>
                        @endif
                    </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">@yield('judul')</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    @yield("kembali")
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                @yield('content')
            </div>

            <footer class="footer text-center">
                All Rights Reserved by UPTD-BLK Karawang. Designed and Developed by @nggrln
            </footer>
        </div>
    </div>

    <script src="{{asset ('/template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset ('/template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.j') }}s"></script>
    <script src="{{asset ('/template/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{asset ('/template/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{asset ('/template/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset ('/template/dist/js/custom.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
