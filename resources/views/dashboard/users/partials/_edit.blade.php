<input type="hidden" name="id" value="{{ $form_data->id }}">
<div class="row mg-tb-30">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="name_edit_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.name')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input value="{{ $form_data->name }}" type="text" id="name_edit_input" name="name" class="form-control"
                   placeholder="@lang('site.name')">
            <span class="help-block" id="name_edit_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="email_edit_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.email')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="email" value="{{ $form_data->email }}" id="email_edit_input" name="email" class="form-control"
                   placeholder="@lang('site.email')">
            <span class="help-block" id="email_edit_error"></span>
        </div>
    </div>
</div>

<div class="row mg-tb-30">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="phone_edit_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.phone')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <input type="tel" id="phone_edit_input" name="phone" value="{{ $form_data->phone }}" class="form-control"
                   placeholder="@lang('site.phone')">
            <span class="help-block" id="phone_edit_error"></span>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="gender_edit_div">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.gender')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <select id="gender_edit_input" name="gender" class="form-control">
                <option value="">@lang('site.select') @lang('site.gender')</option>
                <option {{ $form_data->gender == 1 ? "selected" : '' }} value="1">@lang('site.male')</option>
                <option {{ $form_data->gender == 2 ? "selected" : '' }} value="2">@lang('site.female')</option>
            </select>
            <span class="help-block" id="gender_edit_error"></span>
        </div>
    </div>

</div>

<div class="row mg-tb-30">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="name_edit_div">
        <div class="form-group">
            <input type="file" name="image" id="image_file" class="image">
        </div>

        <div class="form-group">
            @php $image_path = isset($form_data) ? $form_data->image_path : asset('public/photo.svg'); @endphp
            <img class="image-preview" width="200" height="200" src="{{ $image_path }}">
        </div>
    </div>
</div>

