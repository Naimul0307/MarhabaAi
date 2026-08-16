<!-- start of hero -->
<section class="hero hero-slider-wrapper hero-slider-s1">
    <div class="hero-slider">

        @foreach($heroSlides as $slide)
            <div class="slide">
                <img src="{{ asset('uploads/hero_slides/thumb/large/' . $slide->image) }}"
                     alt="{{ $slide->name }}"
                     class="slider-bg">

                <div class="container">
                    <div class="row">
                        <div class="col col-md-10 col-md-offset-1 slide-caption">
                            <h1 class="slide-title">{{ $slide->name }}</h1>
                            <h5 class="slide-subtitle">
                                Industry Segment: Power | 2 min read
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section>
<!-- end of hero -->
