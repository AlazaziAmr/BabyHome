<div class="modal fade" id="set_inspector_model" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.set_inspector')</h4>
                <button onclick="$('#set_inspector_model').modal('hide')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="set_inspector_form" role="form" method="post"
                      action="{{ route(env('DASH_URL').'.nursery.inspector.store') }}">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div id="set_inspector_model_body">
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
