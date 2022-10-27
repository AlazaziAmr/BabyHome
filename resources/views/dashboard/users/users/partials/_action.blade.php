<button onclick="return edit_row('{{ route('__bh_.users.edit',$id) }}')"
        class="btn btn-link text-dark px-3 mb-0">
    <i class="fas fa-pencil-alt text-dark me-2"></i></button>

<button type="button" onclick="delete_process('{{ route('__bh_.users.remove',$id) }}')"
        class="btn btn-link text-danger text-gradient px-3 mb-0">
    <i class="far fa-trash-alt me-2"></i></button>
