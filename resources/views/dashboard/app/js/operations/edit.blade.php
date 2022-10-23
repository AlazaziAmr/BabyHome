<script>
    function edit_row(url) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'text',
            processData: false,
            contentType: false,
            success: function (data) {
                $("#edit_model_body").html(data);
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
                $("#edit-model").modal("show");
            }
        });
    }

    $("#edit_new_form").submit(function (e) {
        e.preventDefault();
        btn = $(this).children('btn');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var actionurl = e.currentTarget.action;
        $.ajax({
            type: 'put',
            url: actionurl,
            data: $("#edit_new_form").serialize(),
            dataType: 'text',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#value').show();
            },
            complete: function () {
                $('button').removeAttr('disabled');
            },
            success: function (data) {
                console.log(data);
                result = jQuery.parseJSON(data);
                if (result.success) {
                    $('#edit-model').modal('hide');
                    swal("{{ __('site.edit') }}", "{{ __('site.updated_successfully') }}", "success");
                    $("table").DataTable().ajax.reload()
                    $('.image-preview').attr('src', '{{ asset('public/photo.svg') }}');
                    $('.image-preview1').attr('src','{{ asset('public/photo.svg') }}');
                    $("#table").DataTable().ajax.reload();
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
                        $("#" + key + "_edit_error").text(val[0]);
                        $("#" + key + "_edit_div").addClass('has-error');
                        html_errors += "<li>" + val[0] + "<\li>";
                    });
                    html_errors += '</ul>';

                    $('#result_error').html(html_errors);
                }
            },
            error: function (data) {

            }
        });
    });
</script>
