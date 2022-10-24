@php
$name = isset($form_data)  ? $form_data->name : '';
$username = isset($form_data)  ? $form_data->username : '';
$email = isset($form_data)  ? $form_data->email : '';
$phone = isset($form_data)  ? $form_data->phone : '';
$role = isset($form_data)  ? $form_data->role : '';
$is_active = isset($form_data)  ? $form_data->is_active : '';
@endphp
<div class="row mg-tb-30">

    <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="name_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.name')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input value="{{ $name }}" type="text" id="name_input" name="name" class="form-control" placeholder="@lang('site.name')">
            <span class="help-block" id="name_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 mb-3  col-xs-12" id="username_div">
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
    <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="email_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.email')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input value="{{ $email }}" type="email" id="email_input" name="email" class="form-control" placeholder="@lang('site.email')">
            <span class="help-block" id="email_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="phone_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.phone')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input value="{{ $phone }}" type="tel" id="phone_input" name="phone" class="form-control" placeholder="@lang('site.phone')">
            <span class="help-block" id="phone_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="is_active_div">
        <div class="nk-int-mk sl-dp-mn">
            <br>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <label>@lang('site.is_active')</label>
            <input {{ $is_active == 1 ? 'checked' : ''}} type="checkbox" id="is_active_input" name="is_active"  placeholder="@lang('site.is_active')">
            <span class="help-block" id="is_active_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="role_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.role')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <select id="role_input" name="role" class="form-control">
                <option value="">@lang('site.select') @lang('site.one_roles')</option>
                <option value="1">@lang('site.super_admin')</option>
                <option value="2">@lang('site.inspector')</option>
                <option value="3">@lang('site.admin')</option>
{{--              @foreach($data['roles'] as $role)--}}
{{--                <option  value="{{ $role->id  }}">{{ $role->name  }}</option>--}}
{{--                @endforeach--}}
            </select>
            <span class="help-block" id="role_error"></span>
        </div>
    </div>

</div>

@if(!isset($form_data))
    <div class="row mg-tb-30">
        <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="password_div">
            <div class="nk-int-mk sl-dp-mn">
                <label>@lang('site.password')</label>
            </div>
            <div class="bootstrap-select fm-cmp-mg">
                <input type="password" id="password_input" name="password" class="form-control" placeholder="@lang('site.password')">
                <span class="help-block" id="password_error"></span>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 mb-3 col-xs-12" id="password_confirmation_div">
            <div class="nk-int-mk sl-dp-mn">
                <label>@lang('site.password_confirmation')</label>
            </div>
            <div class="bootstrap-select fm-cmp-mg">
                <input type="password" id="password_confirmation_input" name="password_confirmation" class="form-control" placeholder="@lang('site.password_confirmation')">
                <span class="help-block" id="password_confirmation_error"></span>
            </div>
        </div>

    </div>
@endif
