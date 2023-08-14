<!doctype html>
<html lang="fr">

<head>

    @php
        $user = Auth::user();
    @endphp

    <meta charset="utf-8" />
    <title> Akanda Pour Tous - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Application" name="description" />
    <meta content="CodeurX" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="icon" href="{{ asset('front/images/ico_apt.png') }}">

    @stack('styles')

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ url('/admin/dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('front/images/logo.png') }}" alt="Akanda Pour Tous" height="17">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('front/images/logo.png') }}" alt="Akanda Pour Tous" height="50">
                            </span>
                        </a>

                        <a href="{{ url('/admin/dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('front/images/logo.png') }}" alt="Akanda Pour Tous" height="17">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('front/images/logo.png') }}" alt="Akanda Pour Tous" height="50">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('admin/images/users/avatar.jpg') }}" alt="LU">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ $user->lastname }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            {{-- <a class="dropdown-item" href="{{ url('/admin/admin-profil') }}"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i>
                                <span key="t-profile">Profil</span></a> --}}
                            <a class="dropdown-item" href="{{ url('/') }}"><i
                                    class="bx bx-home-circle font-size-16 align-middle me-1"></i>
                                <span key="t-profile">Espace Front</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ url('/logout') }}"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                    key="t-logout">Déconnexion</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>

                        <li>
                            <a href="{{ url('/admin/dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Tableau de Bord</span>
                            </a>
                        </li>

                        <li class="menu-title" key="t-apps">Datas</li>

                        <li>
                            <a href="{{ url('/admin/list-members') }}" class="waves-effect">
                                <i class="bx bxs-user"></i>
                                <span key="t-command">Liste des Partisans</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/list-votes') }}" class="waves-effect">
                                <i class="bx bxs-envelope"></i>
                                <span key="t-command">Bilan de Vote</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/list-candidats') }}" class="waves-effect">
                                <i class="bx bxs-user"></i>
                                <span key="t-command">Liste des Candidats</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/list-desks') }}" class="waves-effect">
                                <i class="bx bxs-building"></i>
                                <span key="t-command">Liste des Bureaux de vote</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/list-elections') }}" class="waves-effect">
                                <i class="bx bxs-file"></i>
                                <span key="t-command">Liste des Élections</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Akanda Pour Tous.
                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>

    @stack('scripts')

    <!-- App js -->
    <script src="{{ asset('admin/js/app.js') }}"></script>
</body>

</html>
