@extends('dashboard.layouts.app')
@section('content')
    @php $create = __('site.create').' '.__('site.one_neighborhoods'); @endphp
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
                    @role('superAdmin')
                    <div class="p-3">
                    <p class="mb-0">@lang('site.add_excel')</p>
                    <form method="post" class="mb-5 excel_form7"
                          action="{{ route('__bh_.neighborhoods.store_excel') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="row">
                            <div class="col-md-4">
                                <input type="file" name="file">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-sm btn-success" value="{{ __('site.add') }}">
                            </div>
                        </div>
                    </form>
                    </div>
                    @endrole
                    <div class="table-responsive p-0">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('dashboard.general.neighborhoods.create_model')
    @include('dashboard.general.neighborhoods.edit_model')
@endsection


@push('scripts')
    @include('dashboard.app.js._table_form')
    {!! $dataTable->scripts()  !!}
@endpush
