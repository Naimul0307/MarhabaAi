@extends('layouts.app')

@section('content')

<section class="service-detail-section">

    <div class="container">

        {{-- =========================================================
             SERVICE TITLE
        ========================================================== --}}

        <div class="row">

            <div class="col-12">

                <div class="container py-2">

                    <div class="about-block text-center text-md-left">

                        <h1 class="title-color">
                            {{ $service->localized_name }}
                        </h1>

                        <div class="divider-container">

                            <div class="divider mb-3"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             MAIN SERVICE CONTENT
        ========================================================== --}}

        <div class="row service-main-row">

            {{-- =====================================================
                 MAIN VIDEO / IMAGE
            ====================================================== --}}

            <div class="col-lg-6 col-md-6">

                <div class="service-main-video">

                    @if(!empty($mainVideo))

                        <div
                            class="main-video-card"
                            onclick="openVideoModal('{{ $mainVideo }}')"
                            role="button"
                            tabindex="0"
                            aria-label="Play {{ $service->localized_name }} video"
                        >

                            <div class="main-video-thumbnail">

                                <img
                                    src="https://img.youtube.com/vi/{{ getYoutubeVideoId($mainVideo) }}/maxresdefault.jpg"
                                    alt="{{ $service->localized_name }}"
                                    loading="lazy"
                                >

                                <div class="video-play-button">

                                    <i class="fa-solid fa-play"></i>

                                </div>

                            </div>

                        </div>

                    @elseif(!empty($service->image))

                        <div class="main-service-image">

                            <img
                                src="{{ asset('uploads/services/thumb/small/' . $service->image) }}"
                                alt="{{ $service->image_alt_text ?: $service->localized_name }}"
                                loading="lazy"
                            >

                        </div>

                    @else

                        <div class="service-no-video">

                            <p>
                                {{ __('messages.no_image_or_video') }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                 SHORT CONTENT
            ====================================================== --}}

            <div class="col-lg-6 col-md-6">

                <div
                    class="service-short-content"
                    @if(app()->getLocale() === 'ar') dir="rtl" @endif
                >

                    <h2>
                        {{ $service->localized_name }}
                    </h2>


                    {{-- =================================================
                         SHORT DESCRIPTION
                    ================================================== --}}

                    @if(filled($service->localized_short_desc))

                        <div class="service-short-description">

                            {!! $service->localized_short_desc !!}

                        </div>

                    @endif


                    {{-- =================================================
                         CATEGORY
                    ================================================== --}}

                    @if($service->category)

                        <div class="service-category">

                            <strong>
                                {{ __('messages.category') }}:
                            </strong>

                            {{ $service->category->localized_name }}

                        </div>

                    @endif


                    {{-- =================================================
                         SUB CATEGORY
                    ================================================== --}}

                    @if($service->subCategory)

                        <div class="service-subcategory">

                            <strong>
                                {{ __('messages.sub_category') }}:
                            </strong>

                            {{ $service->subCategory->localized_name }}

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =========================================================
             FULL DESCRIPTION
        ========================================================== --}}

        @if(filled($service->localized_description))

            <div class="row">

                <div class="col-lg-12">

                    <div
                        class="service-full-description"
                        @if(app()->getLocale() === 'ar') dir="rtl" @endif
                    >

                        <h2>
                            {{ __('messages.description') }}
                        </h2>

                        <div class="description-content">

                            {!! $service->localized_description !!}

                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             GALLERY SLIDER
        ========================================================== --}}

        @if(is_array($galleryImages) && count(array_filter($galleryImages)) > 0)

            <section class="service-media-section service-gallery-section">

                <div
                    class="service-media-heading"
                    @if(app()->getLocale() === 'ar') dir="rtl" @endif
                >

                    <h2>
                        {{ __('messages.gallery') }}
                    </h2>

                    <div class="divider-container">

                        <div class="divider mb-3"></div>

                    </div>

                </div>


                <div class="service-media-slider-wrapper">

                    <div class="service-gallery-slider">

                        @foreach($galleryImages as $image)

                            @if(!empty($image))

                                <div class="service-media-slide">

                                    <div class="service-media-card">

                                        <a
                                            href="{{ asset('uploads/services/gallery/' . $image) }}"
                                            class="service-gallery-image-link"
                                            aria-label="{{ __('messages.view_gallery_image') }}"
                                        >

                                            <img
                                                src="{{ asset('uploads/services/gallery/' . $image) }}"
                                                alt="{{ $service->image_alt_text ?: $service->localized_name }}"
                                                class="service-media-image"
                                                loading="lazy"
                                                decoding="async"
                                            >

                                        </a>

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            </section>

        @endif


        {{-- =========================================================
             ADDITIONAL VIDEOS SLIDER
        ========================================================== --}}

        @if(is_array($additionalVideos) && count(array_filter($additionalVideos)) > 0)

            <section class="service-media-section additional-videos-section">

                <div
                    class="service-media-heading"
                    @if(app()->getLocale() === 'ar') dir="rtl" @endif
                >

                    <h2>
                        {{ __('messages.videos') }}
                    </h2>

                    <div class="divider-container">

                        <div class="divider mb-3"></div>

                    </div>

                </div>


                <div class="service-media-slider-wrapper">

                    <div class="additional-videos-slider">

                        @foreach($additionalVideos as $video)

                            @if(!empty($video))

                                <div class="service-media-slide">

                                    <div
                                        class="service-media-card service-video-card"
                                        onclick="openVideoModal('{{ $video }}')"
                                        role="button"
                                        tabindex="0"
                                        aria-label="Play {{ $service->localized_name }} video"
                                    >

                                        <div class="service-video-thumbnail">

                                            <img
                                                src="https://img.youtube.com/vi/{{ getYoutubeVideoId($video) }}/maxresdefault.jpg"
                                                alt="{{ $service->localized_name }}"
                                                class="service-media-image"
                                                loading="lazy"
                                                decoding="async"
                                            >


                                            {{-- =====================================
                                                 CENTER PLAY BUTTON
                                            ====================================== --}}

                                            <div class="service-video-overlay">

                                                <div class="service-video-play">

                                                    <i class="fa-solid fa-play"></i>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            </section>

        @endif

    </div>

</section>


{{-- =========================================================
     VIDEO MODAL
========================================================== --}}

<div
    id="videoModal"
    class="video-modal"
    aria-hidden="true"
>

    <div
        class="video-modal-overlay"
        onclick="closeVideoModal()"
    ></div>


    <div class="video-modal-content">

        <button
            type="button"
            class="video-modal-close"
            onclick="closeVideoModal()"
            aria-label="{{ __('messages.close') }}"
        >
            &times;
        </button>


        <div class="video-modal-wrapper">

            <iframe
                id="videoModalIframe"
                src=""
                frameborder="0"
                allow="autoplay; encrypted-media; picture-in-picture"
                allowfullscreen
            ></iframe>

        </div>

    </div>

</div>


{{-- =========================================================
     YOUTUBE VIDEO ID
========================================================== --}}

@php

function getYoutubeVideoId($url)
{
    if (empty($url)) {
        return '';
    }


    /*
    |--------------------------------------------------------------------------
    | Embed URL
    |--------------------------------------------------------------------------
    */

    if (
        preg_match(
            '/youtube\.com\/embed\/([^?&]+)/',
            $url,
            $matches
        )
    ) {
        return $matches[1];
    }


    /*
    |--------------------------------------------------------------------------
    | Watch URL
    |--------------------------------------------------------------------------
    */

    if (
        preg_match(
            '/youtube\.com\/watch\?v=([^&]+)/',
            $url,
            $matches
        )
    ) {
        return $matches[1];
    }


    /*
    |--------------------------------------------------------------------------
    | Short URL
    |--------------------------------------------------------------------------
    */

    if (
        preg_match(
            '/youtu\.be\/([^?&]+)/',
            $url,
            $matches
        )
    ) {
        return $matches[1];
    }


    return '';

}

@endphp


<div class="services-section-divider"></div>

@endsection
