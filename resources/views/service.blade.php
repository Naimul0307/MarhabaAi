@extends('layouts.app')

@section('content')

<div class="page-title">
    <div class="container">
        <h1>{{ $service->name }}</h1>
    </div>
</div>

<section class="service-detail-section">
    <div class="container">

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="service-main-video">

                    @if(!empty($mainVideo))
                        <div class="main-video-card" onclick="openVideoModal('{{ $mainVideo }}')">
                            <div class="main-video-thumbnail">
                                <img
                                    src="https://img.youtube.com/vi/{{ getYoutubeVideoId($mainVideo) }}/maxresdefault.jpg"
                                    alt="{{ $service->name }}"
                                >
                                <div class="video-play-button">
                                    <span>▶</span>
                                </div>
                            </div>
                        </div>
                    @elseif(!empty($service->image))
                        <div class="main-service-image">
                            <img
                                src="{{ asset('uploads/services/thumb/small/' . $service->image) }}"
                                alt="{{ $service->image_alt_text ?? $service->name }}"
                            >
                        </div>
                    @else
                        <div class="service-no-video">
                            <p>No image or video available</p>
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="service-short-content">
                    <h2>{{ $service->name }}</h2>

                    @if(!empty($service->short_desc))
                        <div class="service-short-description">
                            {!! $service->short_desc !!}
                        </div>
                    @endif

                    @if($service->category)
                        <div class="service-category">
                            <strong>Category:</strong>
                            {{ $service->category->name }}
                        </div>
                    @endif

                    @if($service->subCategory)
                        <div class="service-subcategory">
                            <strong>Sub Category:</strong>
                            {{ $service->subCategory->name }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if(!empty($service->description))
            <div class="row">
                <div class="col-lg-12">
                    <div class="service-full-description">
                        <h2>Description</h2>
                        <div class="description-content">
                            {!! $service->description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(is_array($galleryImages) && count(array_filter($galleryImages)) > 0)
            <section class="partners-section service-gallery-section">
                <h2 class="hidden">Gallery</h2>
                <div class="container">
                    <div class="row">
                        <div class="col col-xs-12">
                            <div class="service-gallery-title">
                                <h2>Gallery</h2>
                            </div>

                            <div class="partners-slider service-gallery-slider">
                                @foreach($galleryImages as $image)
                                    @if(!empty($image))
                                        <div class="grid">
                                            <img
                                                src="{{ asset('uploads/services/gallery/' . $image) }}"
                                                alt="{{ $service->image_alt_text ?? $service->name }}"
                                                class="img img-responsive"
                                            >
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(is_array($additionalVideos) && count(array_filter($additionalVideos)) > 0)
            <section class="partners-section additional-videos-section">
                <h2 class="hidden">Additional Videos</h2>
                <div class="container">
                    <div class="row">
                        <div class="col col-xs-12">
                            <div class="service-gallery-title">
                                <h2>Videos</h2>
                            </div>

                            <div class="partners-slider additional-videos-slider">
                                @foreach($additionalVideos as $video)
                                    @if(!empty($video))
                                        <div class="grid">
                                            <div
                                                class="additional-video-card"
                                                onclick="openVideoModal('{{ $video }}')"
                                            >
                                                <div class="additional-video-thumbnail">
                                                    <img
                                                        src="https://img.youtube.com/vi/{{ getYoutubeVideoId($video) }}/hqdefault.jpg"
                                                        alt="{{ $service->name }}"
                                                    >
                                                    <div class="video-play-button">
                                                        <span>▶</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>
</section>

<div id="videoModal" class="video-modal">
    <div class="video-modal-overlay" onclick="closeVideoModal()"></div>

    <div class="video-modal-content">
        <button type="button" class="video-modal-close" onclick="closeVideoModal()">
            &times;
        </button>

        <div class="video-modal-wrapper">
            <iframe
                id="videoModalIframe"
                src=""
                frameborder="0"
                allow="autoplay; encrypted-media; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

@php
function getYoutubeVideoId($url)
{
    if (empty($url)) {
        return '';
    }

    if (preg_match('/youtube\.com\/embed\/([^?&]+)/', $url, $matches)) {
        return $matches[1];
    }

    if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
        return $matches[1];
    }

    if (preg_match('/youtu\.be\/([^?&]+)/', $url, $matches)) {
        return $matches[1];
    }

    return '';
}
@endphp

<script>
function openVideoModal(videoUrl)
{
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoModalIframe');

    if (!modal || !iframe || !videoUrl) {
        return;
    }

    let playUrl = videoUrl;

    if (playUrl.includes('?')) {
        playUrl += '&autoplay=1';
    } else {
        playUrl += '?autoplay=1';
    }

    iframe.src = playUrl;
    modal.classList.add('active');
    document.body.classList.add('video-modal-open');
}

function closeVideoModal()
{
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoModalIframe');

    if (!modal || !iframe) {
        return;
    }

    iframe.src = '';
    modal.classList.remove('active');
    document.body.classList.remove('video-modal-open');
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeVideoModal();
    }
});
</script>

@endsection
