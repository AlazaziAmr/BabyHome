<script>
    function delete_row(id) {
        swal({
            title: "",
            text: "@lang('site.confirm_delete')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('site.yes')",
            closeOnConfirm: false,
            html: false
        }, function () {
            $('#delete-' + id).submit();
        });
    }

    function delete_process(actionurl, id) {
        swal({
            title: "",
            text: "@lang('site.confirm_delete')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('site.yes')",
            closeOnConfirm: false,
            html: false
        }, function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: actionurl,
                dataType: 'text',
                processData: false,
                contentType: false,
                success: function (data) {
                    result = jQuery.parseJSON(data);
                    if (result.success) {
                        $("#table").DataTable().ajax.reload()
                        swal({
                            icon: 'success',
                            title: '{{ __('site.deleted_successfully') }}',
                            text: "",
                            type: "success",
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: '{{ __('site.cannot_delete_item') }}',
                            text: "",
                            type: "error",
                        });
                    }
                },
                error: function (data) {

                }
            });
            return false;
        });
    }
</script>

<script>
    $(".excel_form").submit(function (e) {
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
                if (result.success == '3') {
                    swal({
                        icon: 'error',
                        title: result.msg,
                        text: "",
                        type: "error",
                    });
                } else if (result.success) {

                    swal({
                        icon: 'success',
                        title: '{{ __('site.added_successfully') }}',
                        text: "",
                        type: "success",
                    });
                    $("#table").DataTable().ajax.reload()
                    $('.excel_form').trigger('reset');
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
