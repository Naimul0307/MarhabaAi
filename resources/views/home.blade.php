@extends('layouts.app')

@section('content')

<section class="section-6 py-5">

    <div class="container">

        <h2 class="title-color mb-4">
            {{ __('messages.our') }}
            <span>{{ __('messages.Latest') }}</span>
            {{ __('messages.WORK') }}
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
                            data-category-name="{{ $category->localized_name }}">

                                {{ $category->localized_name }}

                            </a>
                        </li>

                    @endif

                @endforeach

            </ul>

        </div>


        <div class="services-slider-wrapper">

            <div class="services-slider">

                @foreach($homeServices as $service)

                    @php
                        $category = $service->home_category;
                        $subCategory = $service->home_subcategory;
                    @endphp


                    <div class="service-slide"
                         data-category="category-{{ $category->id }}"
                         data-subcategory="subcategory-{{ $subCategory->id }}">


                        <div class="card border-0 text-center service-card">


                            {{-- Service Image --}}

                            <a class="service-card-image-link"
                               href="{{ route('service.detail', $service->slug) }}"
                               aria-label="View {{ $service->localized_name }}">

                                @if(!empty($service->image))

                                    <img
                                        src="{{ asset('uploads/services/thumb/large/' . $service->image) }}"
                                        class="card-img-top"
                                        alt="{{ $service->localized_name }}"
                                        width="400"
                                        height="300"
                                        loading="lazy"
                                        decoding="async">

                                @else

                                    <img
                                        src="{{ asset('uploads/services/thumb/large/caption-cam.webp') }}"
                                        class="card-img-top"
                                        alt="{{ $service->localized_name }}"
                                        width="400"
                                        height="300"
                                        loading="lazy"
                                        decoding="async">

                                @endif

                            </a>


                            {{-- Card Body --}}

                            <div class="card-body p-3">


                                {{-- Sub Category --}}

                                <div class="service-subcategory-name">

                                    {{ $subCategory->localized_name }}

                                </div>


                                {{-- Service Name --}}

                                <h4 class="card-title mt-2">

                                    <a href="{{ route('service.detail', $service->slug) }}">

                                        {{ $service->localized_name }}

                                    </a>

                                </h4>


                                {{-- Short Description --}}

                                <div class="content pt-2">

                                    <p class="card-text">

                                        {{ $service->localized_short_desc }}

                                    </p>

                                </div>


                                {{-- Discover More --}}

                                <a href="{{ route('service.detail', $service->slug) }}"
                                   class="service-action-btn">

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


        {{-- Category Button --}}

        <div class="selected-category-action">

            <a href="{{ route('categories.index') }}"
               class="category-page-btn"
               id="category-page-button">

                <span id="category-page-button-text">

                    {{ __('messages.discover_more') }}

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
                {{ __('messages.some') }}
                <span>{{ __('messages.facts_of_our') }}</span>
                {{ __('messages.WORK') }}
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

                    <h3>{{ __('messages.activations') }}</h3>

                    <div class="fact-line"></div>

                    <p>
                        {{ __('messages.activations_description') }}
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

                    <h3>{{ __('messages.clients') }}</h3>

                    <div class="fact-line"></div>

                    <p>
                        {{ __('messages.clients_description') }}
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

                    <h3>{{ __('messages.rating') }}</h3>

                    <div class="fact-line"></div>

                    <p>
                        {{ __('messages.rating_description') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
