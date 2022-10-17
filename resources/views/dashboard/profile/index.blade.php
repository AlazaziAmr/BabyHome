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
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "  href="{{ route('__bh_.profile') }}" >
                                    <i class="ni ni-single-02"></i>
                                    <span class="ms-2">@lang('site.profile')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " href="{{ route('__bh_.profile.password') }}">
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
                        <form enctype="multipart/form-data" id="edit_new_form" role="form" method="post"
                              action="{{ route('__bh_.update_profile') }}">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @php
                                $name = auth()->user()->name ;
                                $username = auth()->user()->username;
                                $email = auth()->user()->email;
                                $phone = auth()->user()->phone;
                            @endphp
                            <div class="row mg-tb-30">

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="name_div">
                                    <div class="nk-int-mk sl-dp-mn">
                                        <label>@lang('site.name')</label>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <input value="{{ $name }}" type="text" id="name_input" name="name" class="form-control" placeholder="@lang('site.name')">
                                        <span class="help-block" id="name_error"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="username_div">
                                    <div class="nk-int-mk sl-dp-mn">
                                        <label>@lang('site.username')</label>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <input value="{{ $username }}" type="text" id="username_input" name="username" class="form-control" placeholder="@lang('site.username')">
                                        <span class="help-block" id="username_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mg-tb-30">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="email_div">
                                    <div class="nk-int-mk sl-dp-mn">
                                        <label>@lang('site.email')</label>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <input value="{{ $email }}" type="email" id="email_input" name="email" class="form-control" placeholder="@lang('site.email')">
                                        <span class="help-block" id="email_error"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="phone_div">
                                    <div class="nk-int-mk sl-dp-mn">
                                        <label>@lang('site.phone')</label>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <input value="{{ $phone }}" type="tel" id="phone_input" name="phone" class="form-control" placeholder="@lang('site.phone')">
                                        <span class="help-block" id="phone_error"></span>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
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
