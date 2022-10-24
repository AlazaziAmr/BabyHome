@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4">
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
                                    <td>
                                        @php
                                            if($in->status == 0){
                       echo '<span class="badge badge-sm bg-gradient-secondary">'.__('site.assigned').'</span>';
                   }else if($in->status == 1){
                       echo '<span class="badge badge-sm bg-gradient-warning">'.__('site.inprogress').'</span>';
                   }else if($in->status == 2){
                       echo '<span class="badge badge-sm bg-gradient-danger">'.__('site.incomplete').'</span>';
                   }else if($in->status == 3){
                       echo '<span class="badge badge-sm bg-gradient-success">'.__('site.completed').'</span>';
                   }
                                        @endphp
                                    </td>
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
