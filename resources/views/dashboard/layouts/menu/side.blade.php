<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('__bh_.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="@lang('icon.home')"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.home')</span>
            </a>
        </li>

        @php $menu = false; @endphp
        @foreach(auth()->user()->getRoleNames() as $n)
            @if($n =='superAdmin')
                @php $menu = true; @endphp
            @endif
        @endforeach

        @if($menu)
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#users_menu" class="nav-link" aria-controls="pagesExamples"
                   role="button"
                   aria-expanded="true">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('site.user_management')</span>
                </a>
                <div class="collapse" id="users_menu" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('__bh_.admins.index') }}">
                                <span class="sidenav-mini-icon"> # </span>
                                <span class="sidenav-normal">
                                @lang('site.create_delete_accounts')
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('__bh_.nurseries.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="@lang('icon.nurseries')"></i>
                    </div>
                    <span class="nav-link-text ms-1"> @lang('site.nurseries')</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">@lang('site.app_dashboard')</h6>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#general_menu" class="nav-link" aria-controls="pagesExamples"
                   role="button"
                   aria-expanded="true">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('site.general')</span>
                </a>
                <div class="collapse" id="general_menu" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('__bh_.cities.index') }}">
                                <span class="sidenav-mini-icon"> # </span>
                                <span class="sidenav-normal">
                                @lang('site.cities')
                            </span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('__bh_.neighborhoods.index') }}">
                                <span class="sidenav-mini-icon"> # </span>
                                <span class="sidenav-normal">
                                @lang('site.neighborhoods')
                            </span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('__bh_.nationalities.index') }}">
                                <span class="sidenav-mini-icon"> # </span>
                                <span class="sidenav-normal">
                                @lang('site.nationalities')
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#data_menu" class="nav-link" aria-controls="pagesExamples"
                   role="button"
                   aria-expanded="true">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-books text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('site.nursery_data')</span>
                </a>
                <div class="collapse" id="data_menu" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('__bh_.qualifications.index') }}">
                                <span class="sidenav-mini-icon"> # </span>
                                <span class="sidenav-normal">
                                @lang('site.qualifications')
                            </span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('__bh_.amenities.index') }}">
                                <span class="sidenav-mini-icon"> # </span>
                                <span class="sidenav-normal">
                                @lang('site.amenities')
                            </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        @endif

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">@lang('site.inspection')</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('__bh_.inspections.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-active-40  text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.inspections')</span>
            </a>
        </li>

        <form id="logout-form" action="{{ route('adminLogout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
        <li class="nav-item">
            <a class="nav-link " onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-button-power text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1"> @lang('site.logout')</span>
            </a>
        </li>


        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link " href="{{ route('__bh_.masters.index') }}">--}}
        {{--                <div--}}
        {{--                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
        {{--                    <i class="ni ni-favourite-28  text-sm opacity-10"></i>--}}
        {{--                </div>--}}
        {{--                <span class="nav-link-text ms-1"> @lang('site.masters')</span>--}}
        {{--            </a>--}}
        {{--        </li>--}}

        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link " href="{{ route('__bh_.children.index') }}">--}}
        {{--                <div--}}
        {{--                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
        {{--                    <i class="fa fa-heart  text-sm opacity-10"></i>--}}
        {{--                </div>--}}
        {{--                <span class="nav-link-text ms-1"> @lang('site.children')</span>--}}
        {{--            </a>--}}
        {{--        </li>--}}

    </ul>
</div>
