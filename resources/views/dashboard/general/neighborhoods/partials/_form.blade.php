@php $city_id = isset($form_data) ? $form_data->city_id : ''; @endphp
<div class="row mg-tb-30">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="nk-int-mk sl-dp-mn">
            <label>@lang('site.city_id')</label>
        </div>
        <div class="bootstrap-select fm-cmp-mg">
            <select id="city_id_input" name="city_id" class="form-control">
                <option value="">@lang('site.select') @lang('site.one_cities')</option>
                @foreach($data['cities'] as $city)
                    <option {{ $city_id == $city->id  ? 'selected' : '' }} value="{{ $city->id }}">
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            <span class="help-block" id="city_id_error"></span>
        </div>
    </div>
</div>

<div class="row mg-tb-30">
    @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <div class="col-md-6">
            <div class="form-group" id="{{ $locale }}_name_div">
                @php $name[$locale] = isset($form_data) ? $form_data->getTranslation('name',$locale,false) : ""; @endphp
                <label
                    for="{{ $locale }}_name_input">@lang('site.' . $locale . '.name')</label>
                <input name="{{ $locale }}_name" type="text" value="{{ $name[$locale] }}"
                       class="form-control" id="{{ $locale }}_name_input"
                       placeholder="@lang('site.' . $locale . '.name')">
                <span id="{{ $locale }}_name_error" class="help-block"></span>
            </div>
        </div>
    @endforeach
</div>
