<script>
    $("#add_new_form").submit(function (e) {
        e.preventDefault();
        btn = $(this).children('btn');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var actionurl = e.currentTarget.action;
        $.ajax({
            type: 'POST',
            url: actionurl,
            data: new FormData(this),
            dataType: 'text',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#value').show();
            },
            complete: function () {
                $('#value').hide();
                $('button').removeAttr('disabled');
            },
            success: function (data) {
                result = jQuery.parseJSON(data);
                if (result.success == '3'){
                    $('#error_msg').modal(result.msg);
                    $('#error_modal').modal('show');
                }
                else if (result.success) {
                    swal("{{ __('site.create') }}", "{{ __('site.added_successfully') }}", "success");
                    $("#table").DataTable().ajax.reload()
                    $('#create-model').modal('hide');
                    $('#add_new_form').trigger('reset');
                    $("#fajer-table").DataTable().ajax.reload();
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
                        $("#" + key + "_error").text(val[0]);
                        $("#" + key + "_div").addClass('has-error');
                        html_errors += "<li>" + val[0] + "<\li>";
                    });
                    html_errors += '</ul>';
                }
            },
            error: function (data) {

            }
        });
    });
</script>
