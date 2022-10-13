@extends('dashboard.layouts.app')
@section('content')
    @php $create = __('site.create').' '.__('site.one_users'); @endphp
    @include('dashboard.app.breadcumb')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $data['title'] }}</p>
                        <button onclick="$('#create-model').modal('show')" class="btn btn-primary btn-sm ms-auto">{{ $create }}</button>
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


    @if (auth()->user()->hasPermission('users-create'))
        @include('dashboard.users.create_model')
    @endif
    @if (auth()->user()->hasPermission('users-update'))
        @include('dashboard.users.edit_model')
    @endif
@endsection


@push('scripts')
    @php $table_id = 'fajer-table';@endphp
    @include('dashboard.app.js._table_form')
    {!! $dataTable->scripts()  !!}
@endpush
