@extends('layouts.app')

@section('content')

<section class="about-section py-5">

    <div class="container py-2">

        <div class="about-block">

            <h1 class="title-color">

                @foreach($category->subCategories as $subCategory)

                    @if($subCategory->services->isNotEmpty())

                        <span>
                            {{ $subCategory->localized_name }}
                        </span>

                        @if(!$loop->last)
                            <span class="title-separator">.</span>
                        @endif

                    @endif

                @endforeach

            </h1>

            <div class="divider-container">
                <div class="divider mb-3"></div>
            </div>

            <div class="text-muted">
                {{ __('messages.helping_brands_grow') }}
            </div>

        </div>

    </div>

</section>

<section class="section-6 py-5">

    <div class="container">

        @foreach($category->subCategories as $subCategory)

            {{-- Only show subcategory if it has services --}}
            @if($subCategory->services->isNotEmpty())

                <div class="category-service-section">

                    {{-- ============================= --}}
                    {{-- SUBCATEGORY TITLE --}}
                    {{-- ============================= --}}

                    <div class="category-service-heading">

                        <h3>
                            {{ $subCategory->localized_name }}
                        </h3>

                        @if(filled($subCategory->localized_description))

                            <p class="category-description">
                                {{ $subCategory->localized_description }}
                            </p>

                        @endif

                        <div class="divider-container">
                            <div class="divider mb-3"></div>
                        </div>

                    </div>


                    {{-- ============================= --}}
                    {{-- SERVICES SLIDER --}}
                    {{-- ============================= --}}

                    <div class="services-slider-wrapper">

                        <div class="services-slider">

                            @foreach($subCategory->services as $service)

                                <div class="service-slide">

                                    <div class="card border-0 text-center service-card">


                                        {{-- SERVICE IMAGE --}}

                                        <a
                                            class="service-card-image-link"
                                            href="{{ route('service.detail', [
                                                'locale' => app()->getLocale(),
                                                'slug' => $service->slug
                                            ]) }}"
                                            aria-label="{{ $service->localized_name }}"
                                        >

                                            @if(!empty($service->image))

                                                <img
                                                    src="{{ asset('uploads/services/thumb/large/' . $service->image) }}"
                                                    class="card-img-top"
                                                    alt="{{ $service->localized_name }}"
                                                    width="400"
                                                    height="300"
                                                    loading="lazy"
                                                    decoding="async"
                                                >

                                            @else

                                                <img
                                                    src="{{ asset('uploads/services/thumb/large/caption-cam.webp') }}"
                                                    class="card-img-top"
                                                    alt="{{ $service->localized_name }}"
                                                    width="400"
                                                    height="300"
                                                    loading="lazy"
                                                    decoding="async"
                                                >

                                            @endif

                                        </a>


                                        {{-- SERVICE CONTENT --}}

                                        <div class="card-body p-3">

                                            {{-- SUBCATEGORY NAME --}}

                                            <div class="service-subcategory-name">

                                                {{ $subCategory->localized_name }}

                                            </div>


                                            {{-- SERVICE NAME --}}

                                            <h4 class="card-title mt-2">

                                                <a
                                                    href="{{ route('service.detail', [
                                                        'locale' => app()->getLocale(),
                                                        'slug' => $service->slug
                                                    ]) }}"
                                                >

                                                    {{ $service->localized_name }}

                                                </a>

                                            </h4>


                                            {{-- SERVICE DESCRIPTION --}}

                                            <div class="content pt-2">

                                                <p class="card-text">

                                                    {{ $service->localized_short_desc }}

                                                </p>

                                            </div>


                                            {{-- SERVICE BUTTON --}}

                                            <a
                                                href="{{ route('service.detail', [
                                                    'locale' => app()->getLocale(),
                                                    'slug' => $service->slug
                                                ]) }}"
                                                class="service-action-btn"
                                            >

                                                <span>
                                                    {{ __('messages.discover_more') }}
                                                </span>

                                                <i class="fa-solid fa-angle-right"></i>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- ============================= --}}
                    {{-- SUBCATEGORY BUTTON --}}
                    {{-- ============================= --}}

                    <div class="selected-category-action">

                        <a
                            href="{{ route('subcategory.index', [
                                'locale' => app()->getLocale(),
                                'slug' => $subCategory->slug
                            ]) }}"
                            class="category-page-btn"
                        >

                            <span>
                                {{ __('messages.explore_all') }}
                            </span>

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
