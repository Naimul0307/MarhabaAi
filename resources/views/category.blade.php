@extends('layouts.app')

@section('content')
<section class="about-section py-5">
    <div class="container py-2">
        <div class="about-block">
            <h1 class="title-color">
                <span>
                    {{ $category->subCategories
                        ->filter(fn ($subCategory) => $subCategory->services->isNotEmpty())
                        ->map(function ($subCategory) {
                            return trim(
                                preg_replace(
                                    '/\b(Experience|Engage|Insights)\b/i',
                                    '',
                                    $subCategory->name
                                )
                            );
                        })
                        ->filter()
                        ->implode('. ') }}
                </span>
            </h1>
            <div class="divider-container">
                <div class="divider mb-3"></div>
            </div>

            <div class="text-muted">
                — helping brands and agencies grow.
            </div>
        </div>
    </div>
</section>

<section class="section-6 py-5">

    <div class="container">

        @foreach($category->subCategories as $subCategory)

            @if($subCategory->services->count())

                <div class="category-service-section">

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


                    <div class="services-slider-wrapper">

                        <div class="services-slider">

                            @foreach($subCategory->services as $service)

                                <div class="service-slide">

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

                                            <div class="content pt-2">

                                                <p class="card-text">
                                                    {{ $service->short_desc ?: '' }}
                                                </p>

                                            </div>

                                            <a
                                                href="{{ route('service.detail', $service->slug) }}"
                                                class="service-action-btn"
                                            >

                                                <span>Discover More</span>

                                                <i class="fa-solid fa-angle-right"></i>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- SUBCATEGORY PAGE BUTTON --}}

                <div class="selected-category-action">
                    <a
                       href="{{ route('subcategory.index', $subCategory->slug) }}"
                        class="category-page-btn"
                    >
                        <span>Discover More</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                </div>

            @endif

        @endforeach

    </div>

</section>
<div class="services-section-divider"></div>
@endsection
