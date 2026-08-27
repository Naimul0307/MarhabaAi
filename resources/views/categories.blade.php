@extends('layouts.app')

@section('content')
<section class="section-3 py-5">
</section>
<section class="section-2 py-5">
    <div class="container py-2">
        <div class="about-block">
            <h1 class="title-color mb-4 text-center">All <span>CATEGORIES</span></h1>
            <div class="divider-container text-center">
                <div class="divider mb-3"></div>
            </div>
            <div class="mt-2 mb-3 text-muted">ALL CATEGORIES RENTAL DUBAI</div>
            <div class="text-muted">Smarter engagement. Better experiences. Sharper insights — all powered by AI that helps brands and agencies grow.</div>
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
                    <h3>{{ $category->name }}</h3>
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
                                                    <span>See In Action</span>
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
                            <span>View {{ $category->name }}</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                </div>

            @endif

        @endforeach

    </div>
</section>

@endsection
