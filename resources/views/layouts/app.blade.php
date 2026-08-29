<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2606KHQ743"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-2606KHQ743');
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification"
          content="DRjpAQfoniJxaRdOE3UhWhguZA2bL32hftgz2ymHRYI">

    <title>
        {{ $meta_title ?? 'MIRROR BOOTH EVENT SERVICES L.L.C.-DUBAI' }}
    </title>

    <link rel="canonical"
          href="{{ $meta_canonical ?? url()->current() }}">

    <meta name="title"
          content="{{ $meta_title ?? 'MIRROR BOOTH EVENT SERVICES L.L.C.-DUBAI' }}">

    <meta name="description"
          content="{{ $meta_description ?? 'Default description' }}">

    <meta name="keywords"
          content="{{ $meta_keywords ?? 'Default, Keywords' }}">

    <meta name="_token"
          content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="shortcut icon"
          href="{{ asset('favicon.ico') }}"
          type="image/x-icon">

    <link rel="apple-touch-icon"
          href="{{ asset('apple-touch-icon.png') }}"
          sizes="180x180">

    <link rel="icon"
          href="{{ asset('android-chrome-192x192.png') }}"
          sizes="192x192"
          type="image/png">

    <link rel="icon"
          href="{{ asset('android-chrome-512x512.png') }}"
          sizes="512x512"
          type="image/png">


    {{-- ========================================================= --}}
    {{-- HERO IMAGE PRELOAD --}}
    {{-- ========================================================= --}}

    @php
        $firstHeroImage = null;

        if (isset($heroSlides)) {
            $firstHero = collect($heroSlides)->first(function ($slide) {
                return !empty(
                    is_array($slide)
                        ? ($slide['image'] ?? null)
                        : ($slide->image ?? null)
                );
            });

            if ($firstHero) {
                $firstHeroImage = is_array($firstHero)
                    ? ($firstHero['image'] ?? null)
                    : ($firstHero->image ?? null);
            }
        }
    @endphp

    @if (!empty($firstHeroImage))
        <link
            rel="preload"
            as="image"
            href="{{ asset('uploads/hero_slides/thumb/large/' . $firstHeroImage) }}"
            fetchpriority="high"
        >
    @endif


    {{-- ========================================================= --}}
    {{-- MAIN CSS --}}
    {{-- ========================================================= --}}

    <link rel="stylesheet"
          href="{{ asset('assets/css/all-styles.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('assets/css/navebar.css') }}">

    <link rel="stylesheet"
          href="{{ asset('assets/css/hero.css') }}">


    {{-- ========================================================= --}}
    {{-- FONT AWESOME --}}
    {{-- ========================================================= --}}

    <link rel="preload"
          href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet"
              href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
    </noscript>


    <link rel="preload"
          href="{{ asset('assets/fontawesome/css/solid.min.css') }}"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet"
              href="{{ asset('assets/fontawesome/css/solid.min.css') }}">
    </noscript>


    <link rel="preload"
          href="{{ asset('assets/fontawesome/css/brands.min.css') }}"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet"
              href="{{ asset('assets/fontawesome/css/brands.min.css') }}">
    </noscript>


    @yield('extraCss')

</head>


<body id="top">


    {{-- ========================================================= --}}
    {{-- GLOBAL SETTINGS --}}
    {{-- ========================================================= --}}

    @php
        $settings = getSettings();
    @endphp


    {{-- ========================================================= --}}
    {{-- WHATSAPP FLOATING BUTTON --}}
    {{-- ========================================================= --}}

    @if(!empty($settings) && !empty($settings->whatsapp_url))

        <a href="{{ $settings->whatsapp_url }}"
           class="whatsapp-button"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Chat with us on WhatsApp">

            <img src="{{ asset('uploads/WhatsApp.svg') }}"
                 alt=""
                 width="24"
                 height="24"
                 aria-hidden="true">

            <span>Chat with us</span>

        </a>

    @endif


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    @include('layouts.header')


    {{-- ========================================================= --}}
    {{-- HERO SLIDER ONLY ON HOME PAGE --}}
    {{-- ========================================================= --}}

    @if(isset($showHero) && $showHero === true)

        @include('layouts.hero_slider')

    @endif


    {{-- ========================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ========================================================= --}}

    <main id="main-content">

        @yield('content')

    </main>


    {{-- ========================================================= --}}
    {{-- REVIEW + COMPANY ONLY ON HOME PAGE --}}
    {{-- ========================================================= --}}

    @if(isset($showHomeSliders) && $showHomeSliders === true)

        @include('layouts.review')

        @include('layouts.company')

    @endif


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('layouts.footer')


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"
            defer></script>

    <script src="{{ asset('assets/js/slick.min.js') }}"
            defer></script>

    <script src="{{ asset('assets/js/custom.js') }}"
            defer></script>

    <script src="{{ asset('assets/js/nav-bar.js') }}"
            defer></script>


    {{-- ========================================================= --}}
    {{-- AJAX CSRF --}}
    {{-- ========================================================= --}}

    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

        });
    </script>


    {{-- ========================================================= --}}
    {{-- HERO CAROUSEL --}}
    {{-- ========================================================= --}}

    <script>

        window.addEventListener('load', function () {

            setTimeout(function () {

                const heroCarousel =
                    document.querySelector('#heroCarousel');

                if (heroCarousel) {

                    new bootstrap.Carousel(heroCarousel, {
                        interval: 4000,
                        ride: 'carousel'
                    });

                }

            }, 3000);

        });


        window.addEventListener('load', function () {

            const heroCarousel =
                document.querySelector('#heroCarousel');

            if (!heroCarousel ||
                typeof bootstrap === 'undefined') {

                return;

            }

            setTimeout(function () {

                heroCarousel.classList.add('carousel-fade');

                new bootstrap.Carousel(heroCarousel, {
                    interval: 4000,
                    ride: 'carousel'
                });

            }, 1500);

        });

    </script>


    @stack('extraJs')

</body>
</html>
