@extends('dashboard.layouts.app')
@section('content')
    @php $create = __('site.create').' '.__('site.one_amenities'); @endphp
    @include('dashboard.app.breadcumb')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $data['title'] }}</p>
                        @role('superAdmin')
                        <button onclick="$('#create-model').modal('show')"
                                class="btn btn-primary btn-sm ms-auto">{{ $create }}</button>
                        @endrole
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('dashboard.nurseries.addtional.amenities.create_model')
    @include('dashboard.nurseries.addtional.amenities.edit_model')
@endsection


@push('scripts')
    @include('dashboard.app.js._table_form')
    {!! $dataTable->scripts()  !!}
@endpush
