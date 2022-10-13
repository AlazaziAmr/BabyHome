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
            <a data-bs-toggle="collapse" href="#users_menu" class="nav-link" aria-controls="pagesExamples" role="button" aria-expanded="true">
                <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">@lang('site.users')</span>
            </a>
            <div class="collapse show" id="users_menu" style="">
                <ul class="nav ms-4">
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route(env('DASH_URL').'.admins.index') }}">
                            <span class="sidenav-mini-icon"> # </span>
                            <span class="sidenav-normal">
                                @lang('site.admins')
                            </span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route(env('DASH_URL').'.inspectors.index') }}">
                            <span class="sidenav-mini-icon"> # </span>
                            <span class="sidenav-normal">
                                @lang('site.inspectors')
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
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
            <a class="nav-link " href="{{ route(env('DASH_URL').'.masters.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-favourite-28 text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.masters')</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route(env('DASH_URL').'.children.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-heart text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.children')</span>
            </a>
        </li>

    </ul>
</div>
