@extends('dashboard.layouts.app')
@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $data['babysitter']->getMainAttachmentAttribute() }}" alt="profile_image"
                             class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">

                        </h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="#nursery" role="tab" aria-selected="true">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">@lang('site.owner')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="baby_sitter_tab_link"
                                   class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="#baby_sitter" role="tab" aria-selected="false">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">@lang('site.babysitter')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="#amenities" role="tab" aria-selected="false">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">@lang('site.amenities')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="#utilities" role="tab" aria-selected="false">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">@lang('site.utilities')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="#services" role="tab" aria-selected="false">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">@lang('site.services')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @php $inspect = true; @endphp
                        <form id="add_new_form" enctype="multipart/form-data" method="post" action="{{ route('__bh_.inspections.store') }}" novalidate>
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <input type="hidden" name="id" value="{{ $data['ins']->id }}">
                            <div class="tab-content">
                                @include('dashboard.nurseries.nurseries.profile.nursery')
                                @include('dashboard.nurseries.nurseries.profile.babysitter')
                                @include('dashboard.nurseries.nurseries.profile.amenities')
                                @include('dashboard.nurseries.nurseries.profile.utilities')
                                @include('dashboard.nurseries.nurseries.profile.services')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        function activaTab(tab) {
            $('.nav-pills a[href="#' + tab + '"]').tab('show');
        };
    </script>
    <script>
        $("#add_new_form").submit(function (e) {
            e.preventDefault();
            btn = $(this).children('btn');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var actionurl = e.currentTarget.action;
            $.ajax({
                type: 'POST',
                url: actionurl,
                data: new FormData(this),
                dataType: 'text',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#value').show();
                },
                complete: function () {
                    $('#value').hide();
                    $('button').removeAttr('disabled');
                },
                success: function (data) {
                    result = jQuery.parseJSON(data);
                    if (result.success == '3'){
                        $('#error_msg').modal(result.msg);
                        $('#error_modal').modal('show');
                    }
                    else if (result.success) {
                        swal("{{ __('site.create') }}", "{{ __('site.added_successfully') }}", "success");
                        location.reload();
                        $('#add_new_form').trigger('reset');
                        $('.form-group').removeClass('has-error');
                        $('.help-block').text('');
                    } else {
                        var errors = result.errors;
                        var html_errors = '<ul>';

                        $('#error').html('');
                        $.each(errors, function (key, val) {
                            key = key.replace('[', '');
                            key = key.replace(']', '');
                            key = key.replace('.', '');
                            $("#" + key + "_error").text(val[0]);
                            $("#" + key + "_div").addClass('has-error');
                            html_errors += "<li>" + val[0] + "<\li>";
                        });
                        html_errors += '</ul>';
                    }
                },
                error: function (data) {

                }
            });
        });
    </script>
@endpush
