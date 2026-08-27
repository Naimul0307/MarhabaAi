@extends('layouts.app')

@section('content')

<section class="section-6 py-5">

    <div class="container">

        <h2 class="title-color mb-4">
            Our <span>Latest</span> WORK
        </h2>

        <div class="divider-container">
            <div class="divider mb-3"></div>
        </div>

        <div class="category-filter-wrapper">

            <ul class="portfolio-sorting gallery-button list-inline text-center">

                @foreach($categories as $category)

                    @php
                        $categoryServices = $category->subCategories
                            ->flatMap(fn ($subCategory) => $subCategory->services);
                    @endphp

                    @if($categoryServices->isNotEmpty())

                        <li>
                            <a href="#"
                               class="filter-btn"
                               data-category="category-{{ $category->id }}"
                               data-category-slug="{{ $category->slug }}"
                               data-category-name="{{ $category->name }}">
                                {{ $category->name }}
                            </a>
                        </li>

                    @endif

                @endforeach

            </ul>

        </div>

        <div class="services-slider-wrapper">

            <div class="services-slider">

                @foreach($categories as $category)

                    @php
                        $categoryServices = $category->subCategories
                            ->flatMap(fn ($subCategory) => $subCategory->services);
                    @endphp

                    @if($categoryServices->isNotEmpty())

                        @foreach($category->subCategories as $subCategory)

                            @foreach($subCategory->services as $service)

                                <div class="service-slide"
                                     data-category="category-{{ $category->id }}"
                                     data-subcategory="subcategory-{{ $subCategory->id }}">

                                    <div class="card border-0 text-center service-card">

                                        <a class="service-card-image-link"
                                           href="{{ route('service.detail', $service->slug) }}"
                                           aria-label="View {{ $service->name }}">

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

                                            <a href="{{ route('service.detail', $service->slug) }}"
                                               class="service-action-btn">

                                                <span>See In Action</span>
                                                <i class="fa-solid fa-angle-right"></i>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        @endforeach

                    @endif

                @endforeach

            </div>

        </div>

        <div class="selected-category-action">

            <a href="{{ route('categories.index') }}"
               class="category-page-btn"
               id="category-page-button">

                <span id="category-page-button-text">
                    View All Categories
                </span>

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </div>

</section>

<section class="facts-section">

    <div class="container">

        <div class="facts-heading">

            <h2>
                SOME <span> FACTS OF OUR </span> WORK
            </h2>

            <div class="divider-container">
                <div class="divider"></div>
            </div>

        </div>

        <div class="row facts-row">

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="fact-item">

                    <div class="fact-number">

                        <span
                            class="counter-number"
                            data-target="50">
                            0
                        </span>

                        <span class="counter-suffix">+</span>

                    </div>

                    <h3>Activation</h3>

                    <div class="fact-line"></div>

                    <p>
                        Successfully completed projects
                        delivered with quality and attention
                        to detail.
                    </p>

                </div>

            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="fact-item">

                    <div class="fact-number">

                        <span
                            class="counter-number"
                            data-target="25">
                            0
                        </span>

                        <span class="counter-suffix">+</span>

                    </div>

                    <h3>Clients</h3>

                    <div class="fact-line"></div>

                    <p>
                        Trusted by clients who value
                        professional service and memorable
                        experiences.
                    </p>

                </div>

            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="fact-item">

                    <div class="fact-number">

                        <span
                            class="counter-number"
                            data-target="5">
                            0
                        </span>

                        <span class="counter-suffix">*</span>

                    </div>

                    <h3>Rating</h3>

                    <div class="fact-line"></div>

                    <p>
                        Our commitment to quality helps us
                        deliver experiences our clients love.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
