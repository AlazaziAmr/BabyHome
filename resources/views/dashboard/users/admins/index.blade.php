@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $data['title'] }}</p>
                        <a href="{{ route('__bh_.admins.create') }}" class="btn btn-primary btn-sm ms-auto">{{ __('site.create').' '.__('site.one_admins') }}</a>
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

    @if (auth()->user()->hasPermission('cities-create'))
        @include('dashboard.cities.create_model')
    @endif
    @if (auth()->user()->hasPermission('cities-update'))
        @include('dashboard.cities.edit_model')
    @endif
@endsection


@push('scripts')
    @include('dashboard.app.js._table_form')
    {!! $dataTable->scripts()  !!}
@endpush
