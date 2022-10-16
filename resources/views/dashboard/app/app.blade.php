@include('dashboard.app.layouts.header')
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="{{ route('__bh_.index') }}"><img  width="80px" src="{{ asset('public/logo.jpg') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        <li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-alarm"></i></span></a>
                            <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                <div class="hd-mg-tt">
                                    <h2>@lang('site.orders')</h2>
                                </div>
                                <div class="hd-message-info">
                                    @foreach($settings['orders'] as $order)
                                        <a href="{{ route('__bh_.orders.show',$order->id) }}">
                                            <div class="hd-message-sn">
                                                <div class="hd-mg-ctn">
                                                    <h3>
                                                        {{ $order->user->name }}
                                                    </h3>
                                                    <p>
                                                        {{ date('Y-m-d',strtotime($order->created_at)) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>

                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-support"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span>{{ $settings['orders']->count() }}</span></div></a>
                            <div role="menu" class="dropdown-menu message-dd task-dd animated zoomIn">
                                <div class="hd-message-info hd-task-info">
                                    <a href="{{ route('__bh_.profile') }}">
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                <h3>@lang('site.profile')</h3>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('__bh_.profile.password') }}">
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                <h3>@lang('site.change_password')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-flag"></i></span></a>
                            <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                <div class="hd-message-info">
                                    <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                <h3>English</h3>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                <h3>العربية</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.app.layouts.menu')
@yield('content')
@include('dashboard.app.layouts.footer')
