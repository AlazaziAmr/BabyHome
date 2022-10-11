<div id="utilities" class="container tab-pane"><br>
    <ul>
        @foreach($data['utilities'] as $utility)
            <li>{{ ($utility->utility) ? $utility->utility->name : '' }}</li>
        @endforeach
    </ul>
    @if(isset($inspect) and $inspect)
        @php
            $c = 'utility';
            $next = 'services';
            $prev = 'amenities';
        @endphp
        @include('dashboard.nurseries.inspections.partials._evaluate')
    @endif
</div>
