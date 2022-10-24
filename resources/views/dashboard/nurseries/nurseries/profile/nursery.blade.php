<div id="nursery" class="container tab-pane active"><br>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm ">
            <span class="font-weight-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                     class="mr-75 feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                @lang('site.name'):
            </span> &nbsp;
                    {{ $data['nursery']->owner ? $data['nursery']->owner->name : ''  }} </li> <hr>

                <li class="list-group-item border-0 ps-0 text-sm ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         cols-md="4"
                         class="mr-75 feather feather-phone">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <strong class="font-weight-bold">@lang('site.phone'):</strong>
                    &nbsp; {{ $data['nursery']->owner ? $data['nursery']->owner->phone : ''  }} </li> <hr>

                <li class="list-group-item border-0 ps-0 text-sm ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         cols-md="4"
                         class="mr-75 feather feather-file-minus">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                    <strong class="font-weight-bold">@lang('site.email'):</strong>
                    &nbsp; {{ $data['nursery']->owner ? $data['nursery']->owner->email : ''  }} </li> <hr>

            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm ">
            <span class="font-weight-bold">
               <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                    class="mr-75 feather feather-star">
                <polygon
                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
                @lang('site.capacity'):
            </span> &nbsp;
                    {{ $data['nursery']->capacity }} </li> <hr>

                <li class="list-group-item border-0 ps-0 text-sm ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         cols-md="4"
                         class="mr-75 feather feather-calendar">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <strong class="font-weight-bold">@lang('site.date_of_birth'):</strong>
                    &nbsp; {{ $data['babysitter']->date_of_birth }}  </li> <hr>

                <li class="list-group-item border-0 ps-0 text-sm ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         cols-md="4"
                         class="mr-75 feather feather-file-minus">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                    <strong class="font-weight-bold">@lang('site.languages'):</strong>
                    &nbsp;
                    @if($data['nursery']->languages)
                        @foreach($data['nursery']->languages as $l)
                            <span
                                class="badge mx-1 badge-light-success"> {{ $l->name }} </span>
                        @endforeach
                    @endif

                 </li> <hr>

            </ul>
        </div>
    </div>
  
    <div class="row mt-2">
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" cols-md="4"
                 class="mr-75 feather feather-flag">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                <line x1="4" y1="22" x2="4" y2="15"></line>
            </svg>
            <span class="font-weight-bold">@lang('site.skills')</span></div>
        <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-6">
            @foreach($data['skills'] as $skill)
                <span class="badge mx-1 badge-light-success"> {{ $skill->name }} </span>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row mt-2">
        <span class="font-weight-bold">@lang('site.qualifications')</span>
        @foreach($data['qualifications'] as $q)
            <div class="col-md-6">
                <li>{{ ($q->qualification) ? $q->qualification->name : '' }} </li> <hr>
                <p>{{ $q->description }}</p>
            </div>
        @endforeach
    </div>
    @if(isset($inspect) and $inspect)
        @php
            $c = 'nursery';
            $next = 'baby_sitter';
            $prev = '';
        @endphp
        @include('dashboard.nurseries.inspections.partials._evaluate')
    @endif
</div>
