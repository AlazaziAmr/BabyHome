@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
{{--                    <div class="row" style="padding: 20px">--}}
{{--                        <div class="col-md-2">--}}
{{--                            <a href="{{ route('__bh_.nurseries.index') }}" class="badge badge-sm bg-gradient-info">@lang('site.all')</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}
{{--                            <a href="{{ route('__bh_.nurseries.index',['status' => 6]) }}" class="badge badge-sm bg-gradient-secondary">@lang('site.submitted')</a>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-2">--}}
{{--                            <a href="{{ route('__bh_.nurseries.index',['status' => 2]) }}" class="badge badge-sm bg-gradient-warning">@lang('site.inspecting')</a>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-2">--}}
{{--                            <a href="{{ route('__bh_.nurseries.index',['status' => 3]) }}" class="badge badge-sm bg-gradient-warning">@lang('site.inspected')</a>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-2">--}}
{{--                            <a href="{{ route('__bh_.nurseries.index',['status' => 4]) }}" class="badge badge-sm bg-gradient-danger">@lang('site.suspended')</a>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-2">--}}
{{--                            <a href="{{ route('__bh_.nurseries.index',['status' => 5]) }}" class="badge badge-sm bg-gradient-success">@lang('site.approved')</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <div class="table-responsive p-0">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.nurseries.nurseries.set_inspector_model')
@endsection

@push('scripts')
    @include('dashboard.app.js._table_form')
    @include('dashboard.nurseries.nurseries.partials._js')
    {!! $dataTable->scripts()  !!}
@endpush
