<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">

    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{ route('__bh_.nurseries.show',$id) }}">@lang('site.show')</a></li>

        @if($status < 2)
            <li><a class="dropdown-item"
                   onclick="return set_inspector('{{ route('__bh_.nursery.inspector',['id' => $id]) }}')"
                   href="#">@lang('site.set_inspector')</a></li>
        @endif
        @if($status == 2)
            <li><a class="dropdown-item"
                   onclick="return update_schedule('{{ route('__bh_.nursery.inspector.reschedule',['id' => $id]) }}')"
                   href="#">@lang('site.edit')</a></li>
        @endif
        @if($status == 3)
            @php $i_id = $inspection ? $inspection->id : 0 @endphp
            <li><a class="dropdown-item"
                   href="{{ route('__bh_.inspections.show',$i_id) }}">@lang('site.show') @lang('site.inspections')</a>
            </li>
        @endif
        <li><a class="dropdown-item" onclick="return status_row('{{ route('__bh_.nursery.active',$id) }}',1)"
               href="#">@lang('site.active')</a></li>
        <li><a class="dropdown-item" onclick="return status_row('{{ route('__bh_.nursery.block',$id) }}',2)"
               href="#">@lang('site.block')</a></li>
        <li><a class="dropdown-item" onclick="return delete_process('{{ route('__bh_.nurseries.remove',$id) }}')"
               href="#">@lang('site.delete')</a></li>
    </ul>
</div>
