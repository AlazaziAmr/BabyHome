@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
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
