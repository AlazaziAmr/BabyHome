<div id="amenities" class="container tab-pane"><br>
    <ul>
        @foreach($data['amenities'] as $amenity)
            <li>{{ ($amenity->amenity) ? $amenity->amenity->name : '' }}</li>
            @if($amenity->getImages())
                @foreach($amenity->getImages() as $image)
                    <div class="col-md-4">
                        <div class="card card-plain card-blog mt-4">
                            <div class="card-image border-radius-lg position-relative">
                                <a href="javascript:;">
                                    <div class="blur-shadow-image">
                                        <img class="img border-radius-lg move-on-hover" src="{{ $image }}">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </ul>
    @if(isset($inspect) and $inspect)
        @php
            $c = 'amenity';
            $next = 'utilities';
            $prev = 'baby_sitter';
        @endphp
        @include('dashboard.nurseries.inspections.partials._evaluate')
    @endif
</div>
