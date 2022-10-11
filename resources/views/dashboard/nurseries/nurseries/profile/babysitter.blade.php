<div id="baby_sitter" class="container tab-pane"><br>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-package">
                <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.acceptance_age_from')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ $data['nursery']->acceptance_age_from }} ({{ $data['nursery']->acceptance_age_type == 1 ? 'year'  : 'month' }})  </span>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-package">
                <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.acceptance_age_to')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ $data['nursery']->acceptance_age_to }} </span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span class="font-weight-bold">@lang('site.capacity')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ $data['nursery']->capacity }} </span></div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.country_id')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6"><span
                class="font-weight-bold">{{ ($data['nursery']->country) ? $data['nursery']->country->name : '' }}</span>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.city_id')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ ($data['nursery']->city) ? $data['nursery']->city->name : '' }} </span>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.neighborhood_id')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span
                class="font-weight-bold"> {{ ($data['nursery']->neighborhood) ? $data['nursery']->neighborhood->name : '' }}</span>
        </div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.national_address')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ $data['nursery']->national_address }} </span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.address_description')</span></div>
        <div class="col-4"><span class="font-weight-bold">{{ $data['nursery']->address_description }} </span></div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-check">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span class="font-weight-bold">@lang('status')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6"><span class="font-weight-bold">
                {!! $data['nursery']->getStatusLabel() !!}</span>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.building_type')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ $data['nursery']->building_type }} </span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.price')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold">{{ number_format($data['nursery']->price) }}</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <span class="font-weight-bold"> </span></div>
    </div>

    @if(isset($inspect) and $inspect)
        @php
            $c = 'babysitter';
            $prev = 'nursery';
            $next = 'amenities';
        @endphp
        @include('dashboard.nurseries.inspections.partials._evaluate')
    @endif
</div>
