<div id="services" class="container tab-pane"><br>
    <div class="row">
        <style>
            .card.card-plain{
                    background-color: transparent;
    text-align: center;
    padding: 17px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px !important;
}
            }
            </style>
        @foreach($data['services'] as $service)
            <div class="col-md-4">
                <div class="card card-plain card-blog mt-4">
                    <div class="card-image border-radius-lg position-relative">
                        <a href="javascript:;">
                            <div class="blur-shadow-image">
                                @if($service->service and $service->service->getMainAttachmentAttribute())
                                    <img class="img border-radius-lg move-on-hover"
                                         src="{{ $service->service->getMainAttachmentAttribute() }}">
                                @else
                                    <img style="width:110px" class="img border-radius-lg move-on-hover"
                                         src="{{ asset('photo.svg') }}">
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="card-body px-0">
                        <h5>
                            <a href="javascript:;" class="text-dark font-weight-bold">
                                {{ ($service->service)  ? $service->service->name : ''}}
                            </a>
                        </h5>
                        <ul style="
    text-align: right;
">
                            @if(($service->service)  and $service->service->price)
                                <li>
                                    <b>@lang('site.price'):</b>
                                    {{ ($service->service)  ? $service->service->price : ''}}
                                </li>
                            @endif
                            {{-- <li>
                                <b>@lang('site.is_paid'):</b>
                                {{ ($service->is_paid)  ? ($service->service->is_paid == 1 ? __('site.yes') : __('site.no')) : ''}}
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(isset($inspect) and $inspect)
        @php
            $c = 'service';
             $prev = 'amenities';
            $next = '';
            $submit = true;
        @endphp
        @include('dashboard.nurseries.inspections.partials._evaluate')
    @endif
</div>
