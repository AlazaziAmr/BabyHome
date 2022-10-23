<div class="modal fade" id="edit-model" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.edit') @lang('site.one_cities')</h4>
                <button onclick="$('#edit-model').modal('hide')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="edit_new_form" role="form" method="post"
                      action="{{ route(env('DASH_URL').'.cities.update',0) }}">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div id="edit_model_body">
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
