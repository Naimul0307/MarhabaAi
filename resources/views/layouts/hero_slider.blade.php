@if($heroSlides->isNotEmpty())

<section class="hero">

    <div
        id="heroCarousel"
        class="carousel slide"
        data-bs-ride="carousel"
        data-bs-interval="1500"
        data-bs-pause="false"
        data-bs-touch="true">

        <div class="carousel-inner">

            @foreach($heroSlides as $key => $slide)

                <div
                    class="carousel-item {{ $key === 0 ? 'active' : '' }}">

                    <img
                        src="{{ asset('uploads/hero_slides/thumb/large/' . $slide->image) }}"
                        class="hero-slide-img"
                        alt="{{ $slide->name ?? 'Marhaba AI' }}"
                        loading="{{ $key === 0 ? 'eager' : 'lazy' }}"
                        @if($key === 0)
                            fetchpriority="high"
                        @endif
                        decoding="async"
                        width="1440"
                        height="600">

                    <div
                        class="hero-background-overlay"
                        aria-hidden="true">
                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

<section class="section-2 py-5">

    <div class="container py-2">

        <div class="about-block">

            <h2 class="title-color">
                WHY CHOOSE <span> MARHABA AI </span>
            </h2>

            <div class="divider-container">
                <div class="divider mb-3"></div>
            </div>

            <div class="text-muted">
                Smarter engagement. Better experiences. Sharper insights —
                all powered by AI that helps brands and agencies grow.
            </div>

        </div>

    </div>
</section>

@endif
