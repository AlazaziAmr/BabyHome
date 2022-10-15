<button onclick="return edit_row('{{ route(env('DASH_URL').'.admins.edit',$id) }}')"
        class="btn btn-link text-dark px-3 mb-0">
    <i class="fas fa-pencil-alt text-dark me-2"></i></button>

<button type="button" onclick="delete_process('{{ route(env('DASH_URL').'.admins.remove',$id) }}')"
        class="btn btn-link text-danger text-gradient px-3 mb-0">
    <i class="far fa-trash-alt me-2"></i></button>
