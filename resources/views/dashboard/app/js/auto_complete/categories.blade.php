<script>
   function get_categories(value){
       $('.categories').select2({
           placeholder: '@lang('site.select') @lang('site.one_categories')',
           ajax: {
               url: '{{ route(env('DASH_URL').'.search.categories') }}?parent_id='+value,
               dataType: 'json',
               delay: 250,
               processResults: function (data) {
                   return {
                       results: $.map(data, function (item) {
                           return {text: item.name, id: item.id}
                       })
                   };
               },
               cache: true
           }
       });
   }
</script>
