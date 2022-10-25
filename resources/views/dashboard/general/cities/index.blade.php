@extends('dashboard.layouts.app')
@section('content')
    @php $create = __('site.create').' '.__('site.one_cities'); @endphp
    @include('dashboard.app.breadcumb')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $data['title'] }}</p>
                        <button onclick="$('#create-model').modal('show')"
                                class="btn btn-primary btn-sm ms-auto">{{ $create }}</button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="p-3">
                        <p class="mb-0">@lang('site.add_excel')</p>
                        <form method="post" class="mb-5 excel_form"
                              action="{{ route('__bh_.cities.store_excel') }}" enctype="multipart/form-data">
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
                    <div class="table-responsive p-0">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('dashboard.general.cities.create_model')
    @include('dashboard.general.cities.edit_model')
@endsection


@push('scripts')
    @include('dashboard.app.js._table_form')
    {!! $dataTable->scripts()  !!}
@endpush
