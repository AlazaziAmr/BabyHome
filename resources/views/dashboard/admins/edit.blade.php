@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $data['title'] }}</p>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <form enctype="multipart/form-data" id="edit_new_form" role="form" method="post"
                          action="{{ route(env('DASH_URL').'.admins.update', $form_data->id ) }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="box-body">
                            @include('dashboard.admins.partials._form')
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    @php $table_id = 'fajer-table';@endphp
    @include('dashboard.app.js._table_form')
    <script>

        $('#permissions_all').on('change', function(e) {
            e.stopPropagation();

            if (e.target.checked) {
                $('input').prop( "checked", true );
            } else {
                $('input').prop( "checked", false );
            }
        });

        $('.container_check').on('change', function(e) {
            e.stopPropagation();
            var name = $(this).attr('data-model');
            if (e.target.checked) {
                $('.chk_' + name).prop( "checked", true );
            } else {
                $('.chk_' + name).prop( "checked", false );
            }
        });


    </script>
@endpush
