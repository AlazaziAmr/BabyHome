<div class="row mg-tb-30">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="name_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.name')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="text" id="name_input" name="name" class="form-control" placeholder="@lang('site.name')">
            <span class="help-block" id="name_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="email_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.email')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="email" id="email_input" name="email" class="form-control" placeholder="@lang('site.email')">
            <span class="help-block" id="email_error"></span>
        </div>
    </div>
</div>
<div class="row mg-tb-30">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="phone_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.phone')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="tel" id="phone_input" name="phone" class="form-control" placeholder="@lang('site.phone')">
            <span class="help-block" id="phone_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="gender_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.gender')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <select id="gender_input" name="gender" class="form-control">
                <option value="">@lang('site.select') @lang('site.gender')</option>
                <option value="1">@lang('site.male')</option>
                <option value="2">@lang('site.female')</option>
            </select>
            <span class="help-block" id="gender_error"></span>
        </div>
    </div>

</div>
<div class="row mg-tb-30">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="password_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.password')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="password" id="password_input" name="password" class="form-control" placeholder="@lang('site.password')">
            <span class="help-block" id="password_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="password_confirmation_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.password_confirmation')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="password" id="password_confirmation_input" name="password_confirmation" class="form-control" placeholder="@lang('site.password_confirmation')">
            <span class="help-block" id="password_confirmation_error"></span>
        </div>
    </div>

</div>
    <div class="row mg-tb-30">


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="name_div">
        <div class="form-group">
            <input type="file" name="image" id="image_file" class="image">
        </div>

        <div class="form-group">
            @php $image_path = isset($form_data) ? $form_data->image_path : asset('public/photo.svg'); @endphp
            <img class="image-preview" width="200" height="200" src="{{ $image_path }}">
        </div>
    </div>
</div>

