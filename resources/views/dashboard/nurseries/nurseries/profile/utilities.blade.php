<div id="utilities" class="container tab-pane"><br>
    <ul class="row">
        <style>
           .list-ut {
                list-style-type:none
            }
        </style>
        @foreach($data['utilities'] as $utility)
            <li class="list-ut col-md-4">
                <div class="card">
                    <div class="card-body">{{ ($utility->utility) ? $utility->utility->name : '' }}</</div></div></li>
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
