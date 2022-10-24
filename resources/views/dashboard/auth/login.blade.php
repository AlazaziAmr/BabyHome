<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title> @lang('site.login')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="{{ asset('admin/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('admin/css/argon-dashboard.css')}}?v=2.0.5" rel="stylesheet"/>
</head>

<body  class="{{ app()->getLocale() == 'ar' ? 'rtl' : ''}}">
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">@lang('site.login')</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('adminLogin.store') }}">
                                    {{ csrf_field() }}
                                    {{ method_field('post') }}
                                    <div class="mb-3">
                                        <input type="text" name="username" class="form-control form-control-lg" placeholder="@lang('site.username')" aria-label="username">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="@lang('site.password')" aria-label="Password">
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label"  for="rememberMe">@lang('site.remember_me')</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">@lang('site.login')</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden";>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!--   Core JS Files   -->
<script src="{{ asset('admin/js/core/popper.min.js')}}"></script>
<script src="{{ asset('admin/js/core/bootstrap.min.js')}}"></script>
<script src="{{ asset("admin/js/plugins/perfect-scrollbar.min.js")}}"></script>
<script src="{{ asset("admin/js/plugins/smooth-scrollbar.min.js")}}"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset("admin/js/argon-dashboard.min.js")}}?v=2.0.4"></script>
</body>

</html>
