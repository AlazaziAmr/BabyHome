<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
        <li><a href="{{ route(env('DASH_URL').'.index') }}"><i class="notika-icon notika-house"></i> @lang('site.home')</a>
        </li>
        <li><a data-toggle="tab" href="#products_d_menu"><i class="@lang('icon.products')"></i> @lang('site.products')</a>
        </li>
        <li><a href="{{ route(env('DASH_URL').'.posts.index') }}"><i class="@lang('icon.posts')"></i> @lang('site.posts')</a>
        </li>
        <li><a href="{{ route(env('DASH_URL').'.slides.index') }}"><i class="@lang('icon.slides')"></i> @lang('site.slides')</a>
        </li>
{{--        <li><a  href="{{ route(env('DASH_URL').'.partners.index') }}"><i class="@lang('icon.partners')"></i> @lang('site.partners')</a>--}}
{{--        </li>--}}
        <li><a data-toggle="tab" href="#order_d_menu"><i class="@lang('icon.orders')"></i> @lang('site.orders')</a>
        </li>
        <li><a data-toggle="tab" href="#user_d_menu"><i class="@lang('icon.users')"></i> @lang('site.users')</a>
        </li>
        <li><a data-toggle="tab" href="#setting_d_menu"><i class="@lang('icon.settings')"></i> @lang('site.settings')</a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
        <li><a  href="#" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" style="cursor: pointer">
                <i class="notika-icon notika-close"></i>
                @lang('site.logout')</a>
        </li>
    </ul>
    <div class="tab-content custom-menu-content">
        <div id="products_d_menu" class="tab-pane notika-tab-menu-bg animated flipInX">
            <ul class="notika-main-menu-dropdown">
                <li><a href="{{ route(env('DASH_URL').'.productCategories.index') }}">@lang('site.categories')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.products.index') }}">@lang('site.products')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.units.index') }}"> @lang('site.units')</a>
                </li>
            </ul>
        </div>
        <div id="order_d_menu" class="tab-pane notika-tab-menu-bg animated flipInX">
            <ul class="notika-main-menu-dropdown">
                <li><a href="{{ route(env('DASH_URL').'.orders.index') }}">@lang('site.orders')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.payments.index') }}">@lang('site.payments')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.statues.index') }}">@lang('site.statues')</a>
                </li>
            </ul>
        </div>

        <div id="user_d_menu" class="tab-pane notika-tab-menu-bg animated flipInX">
            <ul class="notika-main-menu-dropdown">
                <li><a href="{{ route(env('DASH_URL').'.admins.index') }}">@lang('site.admins')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.users.index') }}">@lang('site.users')</a>
                </li>
            </ul>
        </div>


        <div id="setting_d_menu" class="tab-pane notika-tab-menu-bg animated flipInX">
            <ul class="notika-main-menu-dropdown">
                <li><a href="{{ route(env('DASH_URL').'.settings.index') }}">@lang('site.settings')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.contacts.index') }}">@lang('site.contacts')</a>
                </li>
                <li><a href="{{ route(env('DASH_URL').'.categories.index') }}">@lang('site.categories')</a>
                </li>
            </ul>
        </div>
    </div>
</div>
