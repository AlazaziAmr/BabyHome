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
    $(".form").submit(function (e) {
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

                if (result.success) {
                    @if(isset($type) and $type == 'edit')
                    swal({
                        icon: 'success',
                        title: '{{ __('site.updated_successfully') }}',
                        text: "",
                        type: "success",
                    });
                    @else
                    swal({
                        icon: 'success',
                        title: '{{ __('site.added_successfully') }}',
                        text: "",
                        type: "success",
                    });
                    $('.form').trigger('reset');
                    @endif
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
