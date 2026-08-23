<section class="hero">
    <div id="heroCarousel"
         class="carousel slide "
         data-bs-interval="4000">

        <div class="carousel-inner">
            @foreach($heroSlides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                    <img
                        src="{{ asset('uploads/hero_slides/thumb/large/' . $slide->image) }}"
                        class="hero-slide-img"
                        alt="{{ $slide->name ?? 'Mirror Booth Dubai' }}"
                        loading="{{ $key === 0 ? 'eager' : 'lazy' }}"
                        @if ($key === 0) fetchpriority="high" @endif
                        decoding="async"
                        width="1440"
                        height="600"
                    >

                    <div class="hero-background-overlay"></div>

                    <div class="hero-content">
                        <div class="container h-100">
                            <div class="row align-items-center justify-content-center h-100">
                                <div class="col-md-8 col-10 text-center">
                                    <h1>{{ $slide->name }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>

<section class="section-2 py-5">
    <div class="container py-2">
        <div class="about-block">
            <h2 class="title-color">WHY CHOOSE <span> MARHABA AI </span></h2>
            <div class="divider-container">
                <div class="divider mb-3"></div>
            </div>
            <div class="text-muted">AI-First approach</div>
            <p> Marhaba AI adopts a fresh approach with technology cutting across advertising services.
            <br>Our focus on leveraging new technologies ensures that your business stays ahead of the curve, reaching new heights of success.</p>
        </div>
    </div>
</section>
