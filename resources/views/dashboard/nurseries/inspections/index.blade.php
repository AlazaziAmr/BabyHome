@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('site.nursery_name')</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('site.from')</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('site.to')</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('site.notes')</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('site.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['inspections'] as $index=>$in)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ (($in->nursery) and $in->nursery->owner) ? $in->nursery->owner->name  :'' }}</td>
                                    <td>{{ $in->from }}</td>
                                    <td>{{ $in->to }}</td>
                                    <td>{{ $in->notes }}</td>
                                    <td>{{ $in->getStatusLabel() }}</td>
                                    <td>
                                        @php $id = $in->id@endphp
                                        @include('dashboard.nurseries.inspections.partials._action')
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.nurseries.nurseries.set_inspector_model')
@endsection

@push('scripts')
{{--    @include('dashboard.app.js._table_form')--}}
{{--    @include('dashboard.nurseries.nurseries.partials._js')--}}
{{--    {!! $dataTable->scripts()  !!}--}}
@endpush
