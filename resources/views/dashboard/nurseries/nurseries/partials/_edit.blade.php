<input type="hidden" name="nursery_id" value="{{ $data['id'] }}">
<div class="row">
    <div class="col-md-12">
        <div class="form-group" id="admin_id_div">
            <label for="admin_id_input" class="form-control-label">@lang('site.name')</label>
            <select class="form-control" id="admin_id_input" name="admin_id">
                <option>@lang('site.select') @lang('site.inspector')</option>
                @foreach($data['inspectors'] as $inspector)
                    <option value="{{ $inspector->id }}">{{ $inspector->name }}</option>
                @endforeach
            </select>
            <span id="admin_id_error"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group" id="from_div">
            <label for="from_input" class="form-control-label">@lang('site.from')</label>
            <input class="form-control" type="date" id="from_input" name="from">
            <span id="from_error"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group" id="to_div">
            <label for="to_input" class="form-control-label">@lang('site.to')</label>
            <input class="form-control" type="date" id="to_input" name="to">
            <span id="to_error"></span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group" id="notes_div">
            <label for="notes_input" class="form-control-label">@lang('site.notes')</label>
            <textarea class="form-control" name="notes" id="notes_input"></textarea>
            <span id="notes_error"></span>
        </div>
    </div>

</div>
