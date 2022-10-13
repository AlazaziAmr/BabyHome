@extends('dashboard.app.app')
@section('content')
    @include('dashboard.app.breadcumb')
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <form role="form" id="add_new_form" method="post" action="{{ route(env('DASH_URL').'.users.store') }}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="box-body">
                                    @include('dashboard.users.partials._form')
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">@lang('site.add')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/css/bootstrap-select/bootstrap-select.css')}}">
@endpush

@push('scripts')
    @php $table_id = 'fajer-table';@endphp
    <script src="{{ asset('public/dashboard/js/bootstrap-select/bootstrap-select.js')}}"></script>
    {!! $dataTable->scripts()  !!}
    @include('dashboard.app.js._table_form')
@endpush
