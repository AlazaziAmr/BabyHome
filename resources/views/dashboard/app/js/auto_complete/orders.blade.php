$('.orders').select2({
        placeholder: '@lang('site.select') @lang('site.one_orders')',
        ajax: {
            url: '{{ route(env('DASH_URL').'.search.orders') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {text: item.id, id: item.id}
                    })
                };
            },
            cache: true
        }
    });
