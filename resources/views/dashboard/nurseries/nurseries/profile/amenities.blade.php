<div id="amenities" class="container tab-pane"><br>
    <ul class="row amenties-list">
        @foreach($data['amenities'] as $amenity)
            <li class="col-md-4 ">{{ ($amenity->amenity) ? $amenity->amenity->name : '' }}
            @if($amenity->getImages())

                @foreach($amenity->getImages() as $image)

                        <div class="card card-plain card-blog mt-4">
                            <div class="card-image border-radius-lg position-relative">
                                <a href="javascript:;">
                                    <div class="blur-shadow-image">
                                        <img class="img img-fluid border-radius-lg move-on-hover" src="{{ $image }}">
                                    </div>
                                </a>
                            </div>
                        </div>


                @endforeach

            @endif
            </li>

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
