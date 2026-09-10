@extends('layouts.app')

@section('content')

<section class="about-section py-5">

    <div class="container py-2">

        <div class="about-block">

            <h1 class="title-color">
                {{ __('messages.our') }}
                <span>{{ $subCategory->localized_name }}</span>
            </h1>

            <div class="divider-container">
                <div class="divider mb-3"></div>
            </div>

            <div class="text-muted">
                {{ __('messages.contact_intro') }}
            </div>

        </div>

    </div>

</section>


<section class="section-6 py-5">

    <div class="container">

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


        @if($services->isNotEmpty())

            <div class="subcategory-services-grid">

                @foreach($services as $service)

                    <div class="subcategory-service-item">

                        <div class="card border-0 text-center service-card">

                            {{-- Service Image --}}

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


                            {{-- Card Body --}}

                            <div class="card-body p-3">

                                <div class="service-subcategory-name">
                                    {{ $subCategory->localized_name }}
                                </div>


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


                                @if(filled($service->localized_short_desc))

                                    <div class="content pt-2">

                                        <p class="card-text">
                                            {{ $service->localized_short_desc }}
                                        </p>

                                    </div>

                                @endif


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

        @else

            <div class="no-services-found text-center">

                <h3>
                    {{ __('messages.no_services_found') }}
                </h3>

                <p>
                    {{ __('messages.no_services_available') }}
                    <strong>
                        {{ $subCategory->localized_name }}
                    </strong>
                </p>

            </div>

        @endif

    </div>

</section>


<div class="services-section-divider"></div>

@endsection
