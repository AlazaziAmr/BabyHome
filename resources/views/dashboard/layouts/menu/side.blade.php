<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route(env('DASH_URL').'.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="@lang('icon.home')"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.home')</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route(env('DASH_URL').'.nurseries.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="@lang('icon.nurseries')"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.nurseries')</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route(env('DASH_URL').'.inspections.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="@lang('icon.inspections')"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.inspections')</span>
            </a>
        </li>


    </ul>
</div>
