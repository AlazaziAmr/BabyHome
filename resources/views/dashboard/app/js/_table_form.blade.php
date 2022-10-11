<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<div class="modal fade" id="error_model" role="dialog">
    <div class="modal-dialog modals-default nk-red">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>@lang('site.error')</h2>
                <p id="error_msg"></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="success_modal" role="dialog">
    <div class="modal-dialog modals-default nk-light-blue">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>@lang('site.alert')</h2>
                <p id="success_msg">

                </p>
            </div>
        </div>
    </div>
</div>

<script>
    $(".image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview').attr('style', 'display: block');
                $('.image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $(".image1").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview1').attr('style', 'display: block');
                $('.image-preview1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<style>
    table.dataTable td, table.dataTable th {
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
        text-align: center !important;
    }
</style>
@include('dashboard.app.js.operations.status')
@include('dashboard.app.js.operations.delete')
@include('dashboard.app.js.operations.create')
@include('dashboard.app.js.operations.edit')


