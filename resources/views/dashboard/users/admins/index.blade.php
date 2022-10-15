@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $data['title'] }}</p>
                        <button onclick="$('#create-model').modal('show')"
                           class="btn btn-primary btn-sm ms-auto">{{ __('site.create').' '.__('site.one_admins') }}</button>
                    @if(auth()->user()->can('create admin'))
                            @endif
                    </div>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('createadmin')
        )

    @endcan
    @include('dashboard.users.admins.create_model')
    @include('dashboard.users.admins.edit_model')
    {{--    @if (auth()->user()->hasPermission('cities-update'))--}}
    {{--        --}}
    {{--    @endif--}}
@endsection


@push('scripts')
    @include('dashboard.app.js._table_form')
    {!! $dataTable->scripts()  !!}
@endpush
