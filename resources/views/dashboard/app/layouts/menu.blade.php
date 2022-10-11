<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a href="{{ route(env('DASH_URL').'.index') }}">@lang('site.home')</a>
                            </li>

                            <li><a data-toggle="collapse" data-target="#products_menu" href="#">@lang('site.products')</a>
                                <ul id="products_menu" class="collapse dropdown-header-top">
                                    <li><a href="{{ route(env('DASH_URL').'.productCategories.index') }}">@lang('site.product_categories')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.units.index') }}">@lang('site.units')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.products.index') }}">@lang('site.products')</a></li>
                                </ul>
                            </li>

                            <li><a href="{{ route(env('DASH_URL').'.posts.index') }}">@lang('site.posts')</a>
                            </li>

{{--                            <li><a href="{{ route(env('DASH_URL').'.partners.index') }}">@lang('site.partners')</a>--}}
{{--                            </li>--}}

                            <li><a href="{{ route(env('DASH_URL').'.orders.index') }}">@lang('site.orders')</a>
                            </li>

                            <li><a data-toggle="collapse" data-target="#user_menu" href="#"> @lang('site.users')</a>
                                <ul id="general_menu" class="collapse dropdown-header-top">
                                    <li><a href="{{ route(env('DASH_URL').'.admins.index') }}">@lang('site.admins')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.users.index') }}">@lang('site.users')</a></li>
                                </ul>
                            </li>

                            <li><a data-toggle="collapse" data-target="#order_menu" href="#">@lang('site.orders')</a>
                                <ul id="order_menu" class="collapse dropdown-header-top">
                                    <li><a href="{{ route(env('DASH_URL').'.orders.index') }}">@lang('site.orders')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.payments.index') }}">@lang('site.payments')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.statues.index') }}">@lang('site.statues')</a></li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#setting_menu" href="#">@lang('site.settings')</a>
                                <ul id="setting_menu" class="collapse dropdown-header-top">
                                    <li><a href="{{ route(env('DASH_URL').'.settings.index') }}">@lang('site.settings')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.contacts.index') }}">@lang('site.contacts')</a></li>
                                    <li><a href="{{ route(env('DASH_URL').'.categories.index') }}">@lang('site.categories')</a></li>
                                </ul>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                            <li><a  href="#" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" style="cursor: pointer">@lang('site.logout')</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
           @include('dashboard.app.layouts.menu.desktop')
        </div>
    </div>
</div>
<!-- Main Menu area End-->
