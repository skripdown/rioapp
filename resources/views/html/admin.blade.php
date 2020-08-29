<!DOCTYPE html>
<html lang="{{env('APP_LANG')}}" dir="{{env('APP_DIR')}}">
<head>
    <meta charset="{{env('APP_CHARSET')}}">
    <meta name="viewport" content="{{env('APP_VIEWPORT')}}">
    <meta name="description" content="{{env('APP_DESCRIPTION')}}">
    <meta name="author" content="{{env('APP_AUTHOR')}}">
    <link rel="icon" type="image/png" sizes="{{env('ICON_SIZE')}}" href="{{asset(env('ICON_SOURCE'))}}">
    <link rel="stylesheet" href="{{asset('element/lib/extra/c3/c3.min.css')}}">
    <link rel="stylesheet" href="{{asset('element/lib/core/chartist/dist/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('element/lib/extra/jvector/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{asset('element/lib/extra/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('element/lib/extra/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('element/lib/core/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('element/css/style.min.css')}}">
    @yield('style')
    <script src="{{asset('element/lib/extra/html5shiv/html5shiv.js')}}"></script>
    <script src="{{asset('element/lib/extra/respond/respond.js')}}"></script>
    @yield('script-head')
    <title>{{env('APP_NAME')}} | @yield('title')</title>
</head>
<body>
@include('html.preloader')
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md">
            <div class="navbar-header" data-logobg="skin6">

                <a href="javascript:void(0)" class="nav-toggler waves-effect waves-light d-block d-md-none">
                    <i class="ti-menu ti-close"></i>
                </a>
                <div class="navbar-brand">
                    <a href="{{url('/home')}}">
                        <b class="logo-icon">
                            <img src="{{asset(env('ICON_SOURCE'))}}" alt="homepage" class="dark-logo" style="width: 2.5em">
                            <img src="{{asset(env('ICON_SOURCE'))}}" alt="homepage" class="light-logo" style="width: 2.5em">
                        </b>
                        <span class="logo-text" >
                            {{env('APP_NAME')}}
                        </span>
                    </a>
                </div>
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti-more"></i>
                </a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!--COMPONENT:header-nav-->
                <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                </ul>
                <!--COMPONENT:header-nav-right-->
                <ul class="navbar-nav float-right">
                    <!--COMPONENT:user-profile-->
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!--COMPONENT:user-profile-name-->
                            <span class="ml-2 d-none d-lg-inline-block">
                                    <span class="text-dark">
                                        Profil
                                        <i data-feather="chevron-down" class="svg-icon"></i>
                                    </span>
                                </span>
                        </a>
                        <!--COMPONENT:user-profile-menu-->
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <a href="{{route('logout')}}" class="dropdown-item">
                                <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{url('/home')}}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{url('/pengguna')}}" aria-expanded="false">
                            <i data-feather="grid" class="feather-icon"></i>
                            <span class="hide-menu">Data Peserta</span>
                        </a>
                    </li>
                    <li class="sidebar-item d-none" id="opt-rapat">
                        <a class="sidebar-link sidebar-link" href="{{url('/rapat_terkini')}}" aria-expanded="false">
                            <i data-feather="calendar" class="feather-icon"></i>
                            <span class="hide-menu">Rapat Terkini</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
        @yield('breadcrumb')
        <div class="container-fluid">
            @yield('content')
        </div>
        <!--COMPONENT:main-footer-->
        <footer class="footer text-center text-muted">
            Component Testing {{env('APP_AUTHOR')}}.
        </footer>
    </div>
</div>
@include('script.jquery')
<script src="{{asset('element/lib/core/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('element/lib/core/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('element/lib/core/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('element/js/app-style-switcher.js')}}"></script>
<script src="{{asset('element/js/feather.min.js')}}"></script>
<script src="{{asset('element/lib/core/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('element/js/sidebarmenu.js')}}"></script>
<script src="{{asset('element/js/custom.min.js')}}"></script>
<script src="{{asset('element/lib/extra/c3/d3.min.js')}}"></script>
<script src="{{asset('element/lib/extra/c3/c3.min.js')}}"></script>
<script src="{{asset('element/lib/core/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('element/lib/core/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('element/lib/extra/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('element/lib/extra/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('element/js/pages/dashboards/dashboard1.min.js')}}"></script>
<script src="{{asset('element/lib/extra/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('element/js/pages/datatable/datatable-basic.init.js')}}"></script>
<script src="{{asset('element/lib/extra/prism/prism.js')}}"></script>
<script>
    let toggler;
    $(document).ready(()=>{
        toggler = $('#opt-rapat').get(0);
        @yield('script-body')
    });
    window.setInterval(()=>{
        $.ajax({
            type: 'POST',
            url: '{{url('post_check_admin_rapat')}}',
            data: {_token:'{{csrf_token()}}'},
            success: data=>{
                console.log(data.status);
                const temp = $('#total_rapat').get(0);
                const form_switcher = $('#on-rapat-exist').get(0);
                const no_form = $('#no-form-container').get(0);
                const form = $('#form-container').get(0);
                const rapat_terkini = $('#rapat-terkini-table').get(0);
                if (toggler != null) {
                    if (data.status === '1') {
                        $(toggler).removeClass('d-none');
                        if (form_switcher != null) {
                            $(form_switcher).removeClass('d-none');
                            $(form).addClass('d-none');
                            $(no_form).addClass('d-none');
                        }
                    }
                    else {
                        $(toggler).addClass('d-none');
                        if (form_switcher != null) {
                            $(form_switcher).addClass('d-none');
                            if ($(form).hasClass('d-none'))
                                $(no_form).removeClass('d-none');
                        }
                    }
                }
                if (temp != null) {
                    $(temp).text(data.total_rapat);
                    $('#total_hadir').text(data.total_hadir);
                    $('#total_absen').text(data.total_absen);
                    $('#total_izin').text(data.total_izin);
                }
                if (rapat_terkini != null) {
                    $(rapat_terkini).html(data.html);
                }
            }
        });
    },{{env('APP_REFRESH_RATE')}});

</script>
</body>
</html>
