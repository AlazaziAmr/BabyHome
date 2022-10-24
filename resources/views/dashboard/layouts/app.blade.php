<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : ''}}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset("public/assets/images/fajr_logo_small.png")}}">
    <link rel="icon" type="image/png" href="{{ asset("public/assets/images/fajr_logo_small.png")}}">
    <title>
        {{ $data['title'] }}
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/admin/css/nucleo-icons.css') }}?v=2.0.6" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/admin/css/nucleo-svg.css') }}?v=2.0.6" rel="stylesheet"/>
    @if(app()->getLocale() == 'en')
        <link rel="stylesheet" type="text/css"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css"
              href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

        <link id="pagestyle" href="{{ asset('admin/css/argon-dashboard.css') }}?v=2.0.6" rel="stylesheet"/>
    @else
        <link rel="stylesheet" type="text/css"
              href="{{ asset('/admin/css/ar_bootstrap.min.css') }}?v=2.0.6">
        <link rel="stylesheet" type="text/css"
              href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link id="pagestyle" href="{{ asset('/admin/css/ar_argon-dashboard.css') }}?v=2.0.7" rel="stylesheet"/>
<style>
    .rtl .timeline .timeline-content {
    margin-right: 68px  !important;
    margin-left: 0 !important;
}
</style>
    @endif
    <style>
        hr{
            border-top: 3px solid #405165;
        }
        img{
            max-width: 100%;
        }
        .amenties-listl li:last-child{
margin-top:20px
        }
        .has-error {
            color: red;
        }
        .text-dark{
            color:black !important;
        }
        .horizontal{
            border-top: none
        }.navbar-vertical .navbar-brand>img, .navbar-vertical .navbar-brand-img{

            max-height: 3rem;
    margin-top: -16px;
        }
.timeline:before{
    border-left: none;
}
    </style>
</head>

<body class="g-sidenav-show {{ app()->getLocale() == 'ar' ? 'rtl' : ''}} bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="#" target="_blank">
            <a class="navbar-brand m-0 text-center" href="#" target="_blank">
                <img src="{{ asset("baby-home.3fd18143.png")}}" class="navbar-brand-img" alt="main_logo">
            </a>
    </div>
    <hr class="horizontal dark mt-0">
    @include('dashboard.layouts.menu.side')
</aside>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                           href="javascript:;">@lang('site.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $data['title'] }}</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">{{ $data['title'] }}</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i> {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-item">
                                <a href="{{ route('__bh_.profile') }}"
                                   class="nav-link text-dark font-weight-bold px-0">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">@lang('site.profile')</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="{{ route('adminLogout') }}"
                                   class="nav-link text-dark font-weight-bold px-0"
                                   onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                                    <i class="fa fa-sign-out me-sm-1"></i>
                                    <span class="d-sm-inline d-none">@lang('site.logout')</span>
                                </a>
                                <form id="form-logout" action="{{ route('adminLogout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{--                    <li class="nav-item d-flex align-items-center">--}}
                    {{--                        <a href="{{ route('__bh_.profile') }}"--}}
                    {{--                           class="nav-link text-white font-weight-bold px-0">--}}
                    {{--                            <i class="fa fa-user me-sm-1"></i>--}}
                    {{--                            <span class="d-sm-inline d-none">@lang('site.profile')</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item px-3 d-flex align-items-center">
                        @if(app()->getLocale() == 'ar')
                            <a class="nav-link text-white"
                               href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                English

                            </a>
                        @else
                            <a class="nav-link text-white"
                               href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                                العربية
                            </a>
                        @endif
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ni ni-bell-55 cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            @if(isset($settings['notifications']) and $settings['notifications'])
                                @foreach($settings['notifications'] as $n)
                                   @if($n->type == 1 and $n->mark_as_read == 0)
                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="#" onclick="make_as_read('{{ $n->link }}','{{ $n->id }}')">
                                                <div class="d-flex py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            {{ $n->title ? __('site.'.$n->title)  : '' }}
                                                            {{ $n->description ? __('site.'.$n->description)  : '' }}
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <i class="fa fa-clock me-1"></i>
                                                            {{ date('Y-m-d',strtotime($n->created_at)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            @lang('site.copy')
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('/admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/admin/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/plugins/smooth-scrollbar.min.js') }}"></script>
<script>

</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    @if(app()->getLocale() == 'en')
    <script src="{{ asset('/admin/js/argon-dashboard.min.js') }}?v=2.0.4"></script>

@else
    <script src="{{ asset('/admin/js/argon-dashboard.js') }}?v=2.0.4"></script>

@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"
      integrity="sha512-gOQQLjHRpD3/SEOtalVq50iDn4opLVup2TF8c4QPI3/NmUPNZOk2FG0ihi8oCU/qYEsw4P6nuEZT2lAG0UNYaw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"
        integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function make_as_read(url,id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('__bh_.notifications.read') }}?id="+id,
            dataType: 'text',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#value').show();
            },
            complete: function () {
                $('#value').hide();
                $('button').removeAttr('disabled');
            },
            success: function (data) {
                window.open(url,'_self');
            },
            error: function (data) {

            }
        });
    }
</script>
@stack('scripts')
</body>

</html>
