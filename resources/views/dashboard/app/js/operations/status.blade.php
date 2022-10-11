<script>
    function status_row(url,type){
        msg = type == 1 ? "{{ __('site.confirm_active') }}" : "{{ __('site.confirm_block') }}";
        swal({
            title: msg,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                status_process(url,type);
            } else {
            }
        });
    }

    function status_process(actionurl,type){
        msg = type == 1 ? "{{ __('site.done_active') }}" : "{{ __('site.done_block') }}";
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
                        title: msg,
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
    }
</script>
