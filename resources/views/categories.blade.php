@extends('layouts.app')

@section('content')
<section class="about-section py-5">
    <div class="container py-2">
        <div class="about-block">
            <h1 class="title-color">
                @foreach($categories as $category)
                    <span>{{ $category->name }}</span>
                    @if(!$loop->last)
                        <span class="title-separator">. </span>
                    @endif
                @endforeach
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

        @foreach($categories as $category)

            @php
                $categoryServices = $category->subCategories
                    ->flatMap(fn ($subCategory) => $subCategory->services);
            @endphp

            @if($categoryServices->isNotEmpty())

                <div class="category-service-section">

                <div class="category-service-heading">
                    <h3 class="category-title">
                        {!! str_replace('AI', '<span>AI</span>', $category->name) !!}
                    </h3>
                    @if(!empty($category->description))
                        <div class="category-description">
                            {!! $category->description !!}
                        </div>
                    @endif
                    <div class="divider-container">
                        <div class="divider mb-3"></div>
                    </div>
                </div>


                    <div class="services-slider-wrapper">
                        <div class="services-slider">

                            @foreach($category->subCategories as $subCategory)

                                @foreach($subCategory->services as $service)

                                    <div
                                        class="service-slide"
                                        data-category="category-{{ $category->id }}"
                                        data-subcategory="subcategory-{{ $subCategory->id }}"
                                    >

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

                            @endforeach

                        </div>
                    </div>

                    <div class="selected-category-action">
                        <a
                            href="{{ route('category.detail', $category->slug) }}"
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
