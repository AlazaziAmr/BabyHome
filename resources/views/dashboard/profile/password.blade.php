@extends('dashboard.layouts.app')
@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
{{--                    <div class="avatar avatar-xl position-relative">--}}
{{--                        <img src="{{ auth()->user()->image_path }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">--}}
{{--                    </div>--}}
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name }}
                        </h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1  d-flex align-items-center justify-content-center " href="{{ route('__bh_.profile') }}" >
                                    <i class="ni ni-single-02"></i>
                                    <span class="ms-2">@lang('site.profile')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "  href="{{ route('__bh_.profile.password') }}" >
                                    <i class="ni ni-key-25"></i>
                                    <span class="ms-2">@lang('site.change_password')</span>
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
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ $data['title'] }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="edit_new_form" class="form" method="post" enctype="multipart/form-data"
                              action="{{ route('__bh_.profile.update_password') }}">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <div class="row">
                                <div class="col-md-6" id="old_password_edit_div">
                                    <div class="form-group">
                                        <label>@lang('site.old_password')</label>
                                        <input type="password" name="old_password"
                                               placeholder="@lang('site.old_password')"
                                               class="form-control">
                                        <span id="old_password_edit_error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="password_edit_div">
                                        <label>@lang('site.new_password')  </label>
                                        <input type="password" name="password"
                                               placeholder="@lang('site.new_password') "
                                               class="form-control">
                                        <span id="password_edit_error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="password_confirmation_edit_div">
                                        <label>@lang('site.password_confirmation')</label>
                                        <input type="password" name="password_confirmation"
                                               placeholder="@lang('site.password_confirmation')"
                                               class="form-control">
                                        <span id="password_confirmation_edit_error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit"
                                                onclick="this.disabled = true; $(this).closest('form').submit()"
                                                class="btn btn-primary">@lang('site.edit')</button>
                                    </div>
                                </div>
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
        $("#edit_new_form").submit(function (e) {
            e.preventDefault();
            btn = $(this).children('btn');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var actionurl = e.currentTarget.action;
            $.ajax({
                type: 'post',
                url: actionurl,
                data: new FormData(this),
                dataType: 'text',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#value').show();
                },
                complete: function () {
                    $('button').removeAttr('disabled');
                },
                success: function (data) {
                    console.log(data);
                    result = jQuery.parseJSON(data);
                    if (result.success) {
                        swal("{{ __('site.edit') }}", "{{ __('site.updated_successfully') }}", "success");
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
                            $("#" + key + "_edit_error").text(val[0]);
                            $("#" + key + "_edit_div").addClass('has-error');
                            html_errors += "<li>" + val[0] + "<\li>";
                        });
                        html_errors += '</ul>';

                        $('#result_error').html(html_errors);
                    }
                },
                error: function (data) {

                }
            });
        });
    </script>
@endpush
