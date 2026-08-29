@extends('layouts.app')

@section('content')
<section class="section-3 py-5">
</section>
<section class="section-2 py-5">
    <div class="container py-2">

        <div class="about-block">

            <h1 class="title-color mb-4 text-center">
                Our <span>{{ $subCategory->name }}</span>
            </h1>

            <div class="divider-container text-center">
                <div class="divider mb-3"></div>
            </div>

            <div class="mt-2 mb-3 text-muted">
                {{ $subCategory->name }} RENTAL DUBAI
            </div>

            <div class="text-muted">
               Smarter engagement. Better experiences. Sharper insights — all powered by AI that helps brands and agencies grow.
            </div>
        </div>

    </div>
</section>


<section class="section-6 py-5">

    <div class="container">
                <div class="category-service-heading">
                    <h3>{{ $subCategory->name }}</h3>

                    @if($subCategory->description)
                        <p class="category-description">
                            {{ $subCategory->description }}
                        </p>
                    @endif

                    <div class="divider-container">
                        <div class="divider mb-3"></div>
                    </div>
                </div>
        @if($services->count() > 0)

            <div class="subcategory-services-grid">

                @foreach($services as $service)

                    <div class="subcategory-service-item">

                        <div class="card border-0 text-center service-card">

                            <a
                                class="service-card-image-link"
                                href="{{ route('service.detail', $service->slug) }}"
                                aria-label="View {{ $service->name }}"
                            >

                                @if(!empty($service->image))

                                    <img
                                        src="{{ asset('uploads/services/thumb/large/' . $service->image) }}"
                                        class="card-img-top"
                                        alt="{{ $service->name }}"
                                        width="400"
                                        height="300"
                                        loading="lazy"
                                        decoding="async">

                                @else

                                    <img
                                        src="{{ asset('uploads/services/thumb/large/caption-cam.webp') }}"
                                        class="card-img-top"
                                        alt="{{ $service->name }}"
                                        width="400"
                                        height="300"
                                        loading="lazy"
                                        decoding="async">

                                @endif

                            </a>


                            <div class="card-body p-3">

                                <div class="service-subcategory-name">
                                    {{ $subCategory->name }}
                                </div>


                                <h4 class="card-title mt-2">

                                    <a href="{{ route('service.detail', $service->slug) }}">
                                        {{ $service->name }}
                                    </a>

                                </h4>


                                @if(!empty($service->short_desc))

                                    <div class="content pt-2">

                                        <p class="card-text">
                                            {{ $service->short_desc }}
                                        </p>

                                    </div>

                                @endif


                                <a
                                    href="{{ route('service.detail', $service->slug) }}"
                                    class="service-action-btn"
                                >

                                    <span>Discover More Details</span>

                                    <i class="fa-solid fa-angle-right"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="no-services-found text-center">

                <h3>No Services Found</h3>

                <p>
                    No services are available in
                    <strong>{{ $subCategory->name }}</strong>.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection
