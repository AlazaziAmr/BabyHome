@if (auth()->user()->hasPermission('cities-update'))
    <button onclick="return edit_row('{{ route('__bh_.cities.edit',$id) }}')"
            class="btn btn-link text-dark px-3 mb-0">
        <i class="fas fa-pencil-alt text-dark me-2"></i></button>
@endif

@if (auth()->user()->hasPermission('cities-delete'))
    <button type="button" onclick="delete_process('{{ route('__bh_.cities.remove',$id) }}')" class="btn btn-link text-danger text-gradient px-3 mb-0">
        <i class="far fa-trash-alt me-2"></i></button>
@endif
