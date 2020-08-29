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
    <link rel="stylesheet" href="{{asset('element/css/style.min.css')}}">
    <script src="{{asset('element/lib/extra/html5shiv/html5shiv.js')}}"></script>
    <script src="{{asset('element/lib/extra/respond/respond.js')}}"></script>
    <title>{{env('APP_NAME')}} | user</title>
</head>
<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-boxed-layout="full">

    <header class="topbar" >
        <nav class="navbar top-navbar navbar-expand">
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                </ul>
                <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                            <span class="ml-2 d-none d-lg-inline-block">
                                    <span class="text-dark">
                                        Profil
                                        <i data-feather="chevron-down" class="svg-icon"></i>
                                    </span>
                                </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <a href="javascript:void(0)" class="dropdown-item">
                                <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div >
        <div id="render-container" class="container-fluid">
            <div class="row" style="padding: 35vh 0">
                <div id="no-rapat" class="span6" style="float: none; margin: 0 auto;">
                    <h2>Tidak ada rapat yang sedang berlangsung <span id="dot-timer">.</span></h2>
                    <div class="text-center mt-4">
                        <a href="{{route('logout')}}" class="btn btn-info"><i data-feather="power" class="svg-icon mr-2 ml-1"></i> keluar</a>
                    </div>
                </div>
                <div id="has-rapat" class="span6" style="float: none; margin: 0 auto;">
                    <div id="qr-code"></div>
                </div>
            </div>
        </div>
        <!--COMPONENT:main-footer-->
        <footer class="footer text-center text-muted">
            Component Testing Malkolp.
        </footer>
    </div>
</div>
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
<script src="{{asset('element/lib/core/qrcode/qrcode.js')}}"></script>
<script>
    let iter;
    let timer;
    let no_rapat;
    let has_rapat;
    let qrcode;

    $(document).ready(()=>{
        iter = 1;
        timer = $('#dot-timer').get(0);
        no_rapat = $('#no-rapat').get(0);
        has_rapat = $('#has-rapat').get(0);
        $(has_rapat).addClass('d-none');
        qrcode = new QRCode("qr-code",{
            text: "none",
            width: 152,
            height: 152,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });

    window.setInterval(()=>{
        $.ajax({
            type: 'POST',
            url:'{{url('post_update_qr')}}',
            data:{_token:'{{csrf_token()}}'},
            success: data=>{
                qrcode.clear();
                if (data.status === '1') {
                    $(has_rapat).removeClass('d-none');
                    $(no_rapat).addClass('d-none');
                    if (data.hadir === '1') {
                        $(has_rapat).html(`<h2>Anda telah dicatat hadir!</h2><div class="text-center mt-4"><a href="{{route('logout')}}" class="btn btn-info"><i data-feather="power" class="svg-icon mr-2 ml-1"></i> keluar</a></div>`);
                    }
                    else {
                        qrcode.makeCode(data.qr_code);
                    }
                }
                else {
                    $(no_rapat).removeClass('d-none');
                    $(has_rapat).addClass('d-none');
                }
            }
        });
        if (iter === 1 ) {
            iter++;
            $(timer).text('.');
        }
        else if (iter === 2) {
            iter++;
            $(timer).text('. .');
        }
        else {
            iter = 1;
            $(timer).text('. . .');
        }
    },{{env('APP_REFRESH_RATE')}});
</script>
</body>
</html>
