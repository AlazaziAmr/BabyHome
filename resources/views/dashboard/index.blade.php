@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('site.children')</p>
                                <h5 class="font-weight-bolder">
                                    {{ $data['children'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-air-baloon text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('site.nurseries')</p>
                                <h5 class="font-weight-bolder">
                                    {{ $data['nurseries'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('site.masters')</p>
                                <h5 class="font-weight-bolder">
                                    {{ $data['masters'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('site.inspectors')</p>
                                <h5 class="font-weight-bolder">
                                    {{ $data['inspectors'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-success text-center rounded-circle">
                                <i class="ni ni-settings text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">@lang('site.nurseries')</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('site.city_name')</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('site.total_nurseries')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['cities'] as $index=>$city)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td class="text-center">{{ $city->getNurseries() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">@lang('site.latest_request_joins')</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                        <tr>
                            <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img width="100" src="{{ asset('baby.jpg') }}" alt="">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">الطفل:</p>
                                        <h6 class="text-sm mb-0">احمد محمد</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">تاريخ الطلب:</p>
                                    <h6 class="text-sm mb-0">2022-10-1</h6>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">الحاضنة:</p>
                                    <h6 class="text-sm mb-0">الامل</h6>
                                </div>
                            </td>
                            <td class="align-middle text-sm">
                                <div class="col text-center">
                                    <p class="text-xs font-weight-bold mb-0">الاجمالي:</p>
                                    <h6 class="text-sm mb-0">100 ر.س</h6>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img width="100" height="100" src="{{ asset('baby.jpg') }}" alt="">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">الطفل:</p>
                                        <h6 class="text-sm mb-0">احمد محمد</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">تاريخ الطلب:</p>
                                    <h6 class="text-sm mb-0">2022-10-1</h6>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">الحاضنة:</p>
                                    <h6 class="text-sm mb-0">الامل</h6>
                                </div>
                            </td>
                            <td class="align-middle text-sm">
                                <div class="col text-center">
                                    <p class="text-xs font-weight-bold mb-0">الاجمالي:</p>
                                    <h6 class="text-sm mb-0">100 ر.س</h6>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">@lang('site.latest_nurseries')</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            @foreach($data['latest_nurseries'] as $n)
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{ ($n->owner) ? $n->owner->name : '' }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

