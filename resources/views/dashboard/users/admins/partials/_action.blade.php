@if(auth()->user()->hasRole('admin')  && $role != '-superAdmin<br>')
<button onclick="return edit_row('{{ route('__bh_.admins.edit',$id) }}')"
        class="btn btn-link text-dark px-3 mb-0">
    <i class="fas fa-pencil-alt text-dark me-2"></i>
</button>
@elseif(auth()->user()->hasRole('superAdmin'))
    <button onclick="return edit_row('{{ route('__bh_.admins.edit',$id) }}')"
            class="btn btn-link text-dark px-3 mb-0">
        <i class="fas fa-pencil-alt text-dark me-2"></i>
    </button>
@endif
@role('superAdmin')
<button type="button" onclick="delete_process('{{ route('__bh_.admins.remove',$id) }}')"
        class="btn btn-link text-danger text-gradient px-3 mb-0">
    <i class="far fa-trash-alt me-2"></i>
</button>
@endrole
