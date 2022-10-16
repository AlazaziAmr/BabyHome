<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{ route('__bh_.nurseries.show',$id) }}">@lang('site.show')</a></li>
        <li><a class="dropdown-item" onclick="return set_inspector('{{ route('__bh_.nursery.inspector',['id' => $id]) }}')" href="#">@lang('site.set_inspector')</a></li>
{{--        <li><a class="dropdown-item" onclick="return status_row({{ route('__bh_.nursery.active',$id) }})" href="#">@lang('site.active')</a></li>--}}
{{--        <li><a class="dropdown-item" onclick="return status_row({{ route('__bh_.nursery.block',$id) }})" href="#">@lang('site.block')</a></li>--}}
    </ul>
</div>
