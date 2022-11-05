<input type="hidden" name="nursery_id" value="{{ $inspection->nursery_id }}">
<input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
<div class="row">
    <div class="col-md-12">
        <div class="form-group" id="update_admin_id_div">
            <label for="admin_id_input" class="form-control-label">@lang('site.name')</label>
            <select class="form-control" id="update_admin_id_input" name="admin_id">
                @foreach($data['inspectors'] as $inspector)
                    <option value="{{ $inspector->id }}" {{ $inspector->id == $inspection->inspector_id ? 'selected' : '' }}>{{ $inspector->name }}</option>
                @endforeach
            </select>
            <span id="update_admin_id_error"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group" id="update_from_div">
            <label for="from_input" class="form-control-label">@lang('site.from')</label>
            <input class="form-control" type="datetime-local" id="update_from_input" name="from" value="{{ date('Y-m-d\TH:i:s',strtotime($inspection->from)) }}">
            <span id="update_from_error"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group" id="update_to_div">
            <label for="to_input" class="form-control-label">@lang('site.to')</label>
            <input class="form-control" type="datetime-local" id="update_to_input" name="to" value="{{ date('Y-m-d\TH:i:s',strtotime($inspection->to)) }}">
            <span id="update_to_error"></span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group" id="update_notes_div">
            <label for="notes_input" class="form-control-label">@lang('site.notes')</label>
            <textarea class="form-control" name="notes" id="update_notes_input">{{ $inspection->notes }}</textarea>
            <span id="update_notes_error"></span>
        </div>
    </div>

</div>
