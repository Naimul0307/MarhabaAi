/* =========================================================
   SLICK ACCESSIBILITY
========================================================= */

function fixSlickAccessibility(slider) {

    if (!slider || !slider.length) {
        return;
    }

    const focusable =
        'a[href], button, input, select, textarea, area[href], iframe, [tabindex], [contenteditable="true"], audio[controls], video[controls], summary';


    const hiddenSlides =
        slider.find('.slick-slide[aria-hidden="true"]');


    const visibleSlides =
        slider.find('.slick-slide[aria-hidden="false"]');


    /* =====================================================
       HIDDEN SLIDES
    ===================================================== */

    hiddenSlides
        .attr({
            'tabindex': '-1',
            'inert': ''
        })
        .find(focusable)
        .attr({
            'tabindex': '-1',
            'aria-hidden': 'true',
            'data-slick-a11y-hidden': 'true'
        });


    /* =====================================================
       VISIBLE SLIDES
    ===================================================== */

    visibleSlides
        .removeAttr('tabindex inert')
        .find('[data-slick-a11y-hidden="true"]')
        .removeAttr(
            'tabindex aria-hidden data-slick-a11y-hidden'
        );

}


/* =========================================================
   RUN SLICK ACCESSIBILITY FIX
========================================================= */

function runSlickAccessibilityFix(slider) {

    if (!slider || !slider.length) {
        return;
    }


    fixSlickAccessibility(slider);


    requestAnimationFrame(function () {

        fixSlickAccessibility(slider);

    });


    setTimeout(function () {

        fixSlickAccessibility(slider);

    }, 100);


    setTimeout(function () {

        fixSlickAccessibility(slider);

    }, 500);

}


/* =========================================================
   DOCUMENT READY
========================================================= */

$(document).ready(function () {


    /* =====================================================
       COMMON ARROWS
    ===================================================== */

    const previousArrow = `
        <button
            type="button"
            class="slick-prev"
            aria-label="Previous">
            <i class="fa-solid fa-angle-left"></i>
        </button>
    `;


    const nextArrow = `
        <button
            type="button"
            class="slick-next"
            aria-label="Next">
            <i class="fa-solid fa-angle-right"></i>
        </button>
    `;


    /* =====================================================
       MAIN SLIDER OPTIONS
    ===================================================== */

    const sliderOptions = {

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 4,

        slidesToScroll: 1,

        autoplay: true,

        autoplaySpeed: 2500,

        pauseOnHover: true,

        pauseOnFocus: true,

        accessibility: true,

        adaptiveHeight: false,

        prevArrow: previousArrow,

        nextArrow: nextArrow,

        responsive: [

            {
                breakpoint: 1024,

                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },

            {
                breakpoint: 768,

                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },

            {
                breakpoint: 576,

                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]

    };


    /* =====================================================
       INITIALIZE MAIN SLIDERS
    ===================================================== */

    const sliders = $(
        '.services-slider, .companies-slider, .reviews-slider'
    );


    if (sliders.length) {

        sliders
            .on(
                'init beforeChange afterChange reInit breakpoint setPosition',
                function () {

                    runSlickAccessibilityFix(
                        $(this)
                    );

                }
            )
            .slick(sliderOptions);


        window.addEventListener('load', function () {

            sliders.each(function () {

                runSlickAccessibilityFix(
                    $(this)
                );

            });

        });

    }


    /* =====================================================
       SERVICE CATEGORY FILTER
    ===================================================== */

    const serviceSlider =
        $('.services-slider');


    const filterButtons =
        $('.filter-btn');


    const categoryPageButton =
        $('#categoryPageButton');


    const categoryPageButtonText =
        $('#categoryPageButtonText');


    if (
        serviceSlider.length &&
        filterButtons.length
    ) {


        filterButtons.on('click', function (event) {

            event.preventDefault();


            const button =
                $(this);


            const selectedCategory =
                button.data('category');


            filterButtons.removeClass('active');

            button.addClass('active');


            /* =================================================
               ALL
            ================================================= */

            if (selectedCategory === 'all') {

                serviceSlider.slick(
                    'slickUnfilter'
                );


                if (categoryPageButton.length) {

                    categoryPageButton.attr(
                        'href',
                        categoryPageButton.data(
                            'all-url'
                        ) || '/categories'
                    );

                }


                if (categoryPageButtonText.length) {

                    categoryPageButtonText.text(
                        'View All Categories'
                    );

                }


                runSlickAccessibilityFix(
                    serviceSlider
                );

                return;
            }


            /* =================================================
               CATEGORY
            ================================================= */

            serviceSlider.slick(
                'slickUnfilter'
            );


            serviceSlider.slick(
                'slickFilter',
                '[data-category="' +
                selectedCategory +
                '"]'
            );


            const categoryUrl =
                button.attr(
                    'data-category-url'
                );


            if (
                categoryUrl &&
                categoryPageButton.length
            ) {

                categoryPageButton.attr(
                    'href',
                    categoryUrl
                );

            }


            const categoryName =
                $.trim(
                    button.text()
                );


            if (categoryPageButtonText.length) {

                categoryPageButtonText.text(
                    'View ' +
                    categoryName +
                    ' Services'
                );

            }


            setTimeout(function () {

                runSlickAccessibilityFix(
                    serviceSlider
                );

            }, 50);

        });


        /* =================================================
           CATEGORY PAGE BUTTON
        ================================================= */

        if (categoryPageButton.length) {

            categoryPageButton.attr(
                'data-all-url',
                '/categories'
            );

        }


        /* =================================================
           INITIAL STATE
        ================================================= */

        const firstButton =
            $('.filter-btn.active').first();


        if (firstButton.length) {

            const initialCategory =
                firstButton.data('category');


            if (
                initialCategory === 'all'
            ) {

                if (categoryPageButton.length) {

                    categoryPageButton.attr(
                        'href',
                        '/categories'
                    );

                }


                if (categoryPageButtonText.length) {

                    categoryPageButtonText.text(
                        'View All Categories'
                    );

                }

            }

        }

    }


    /* =====================================================
       DETAIL GALLERY SLIDER
    ===================================================== */

    const gallerySlider =
        $('.service-gallery-slider');


    if (gallerySlider.length) {

        gallerySlider
            .on(
                'init beforeChange afterChange reInit breakpoint setPosition',
                function () {

                    runSlickAccessibilityFix(
                        $(this)
                    );

                }
            )
            .slick({

                dots: false,

                infinite: true,

                speed: 500,

                slidesToShow: 4,

                slidesToScroll: 1,

                autoplay: true,

                autoplaySpeed: 3000,

                pauseOnHover: true,

                pauseOnFocus: true,

                accessibility: true,

                adaptiveHeight: false,

                prevArrow: `
                    <button
                        type="button"
                        class="slick-prev"
                        aria-label="Previous gallery image">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                `,

                nextArrow: `
                    <button
                        type="button"
                        class="slick-next"
                        aria-label="Next gallery image">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                `,

                responsive: [

                    {
                        breakpoint: 1024,

                        settings: {
                            slidesToShow: 3
                        }
                    },

                    {
                        breakpoint: 768,

                        settings: {
                            slidesToShow: 2
                        }
                    },

                    {
                        breakpoint: 576,

                        settings: {
                            slidesToShow: 1
                        }
                    }

                ]

            });


        runSlickAccessibilityFix(
            gallerySlider
        );

    }


    /* =====================================================
       DETAIL VIDEO SLIDER
    ===================================================== */

    const videoSlider =
        $('.additional-videos-slider');


    if (videoSlider.length) {

        videoSlider
            .on(
                'init beforeChange afterChange reInit breakpoint setPosition',
                function () {

                    runSlickAccessibilityFix(
                        $(this)
                    );

                }
            )
            .slick({

                dots: false,

                infinite: true,

                speed: 500,

                slidesToShow: 4,

                slidesToScroll: 1,

                autoplay: true,

                autoplaySpeed: 3000,

                pauseOnHover: true,

                pauseOnFocus: true,

                accessibility: true,

                adaptiveHeight: false,

                prevArrow: `
                    <button
                        type="button"
                        class="slick-prev"
                        aria-label="Previous video">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                `,

                nextArrow: `
                    <button
                        type="button"
                        class="slick-next"
                        aria-label="Next video">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                `,

                responsive: [

                    {
                        breakpoint: 1024,

                        settings: {
                            slidesToShow: 3
                        }
                    },

                    {
                        breakpoint: 768,

                        settings: {
                            slidesToShow: 2
                        }
                    },

                    {
                        breakpoint: 576,

                        settings: {
                            slidesToShow: 1
                        }
                    }

                ]

            });


        runSlickAccessibilityFix(
            videoSlider
        );

    }

});


/* =========================================================
   VIDEO MODAL
========================================================= */

function openVideoModal(videoUrl)
{

    const modal =
        document.getElementById(
            'videoModal'
        );


    const iframe =
        document.getElementById(
            'videoModalIframe'
        );


    if (
        !modal ||
        !iframe ||
        !videoUrl
    ) {

        return;

    }


    /* =====================================================
       PAUSE VIDEO SLIDER
    ===================================================== */

    const videoSlider =
        $('.additional-videos-slider');


    if (
        videoSlider.length &&
        videoSlider.hasClass(
            'slick-initialized'
        )
    ) {

        videoSlider.slick(
            'slickPause'
        );

    }


    /* =====================================================
       PAUSE GALLERY
    ===================================================== */

    const gallerySlider =
        $('.service-gallery-slider');


    if (
        gallerySlider.length &&
        gallerySlider.hasClass(
            'slick-initialized'
        )
    ) {

        gallerySlider.slick(
            'slickPause'
        );

    }


    /* =====================================================
       YOUTUBE URL
    ===================================================== */

    let playUrl =
        videoUrl;


    if (
        playUrl.includes('?')
    ) {

        playUrl +=
            '&autoplay=1';

    } else {

        playUrl +=
            '?autoplay=1';

    }


    /* =====================================================
       LOAD VIDEO
    ===================================================== */

    iframe.src =
        playUrl;


    modal.classList.add(
        'active'
    );


    modal.setAttribute(
        'aria-hidden',
        'false'
    );


    document.body.classList.add(
        'video-modal-open'
    );

}


/* =========================================================
   CLOSE VIDEO MODAL
========================================================= */

function closeVideoModal()
{

    const modal =
        document.getElementById(
            'videoModal'
        );


    const iframe =
        document.getElementById(
            'videoModalIframe'
        );


    if (
        !modal ||
        !iframe
    ) {

        return;

    }


    iframe.src =
        '';


    modal.classList.remove(
        'active'
    );


    modal.setAttribute(
        'aria-hidden',
        'true'
    );


    document.body.classList.remove(
        'video-modal-open'
    );


    /* =====================================================
       RESUME VIDEO SLIDER
    ===================================================== */

    const videoSlider =
        $('.additional-videos-slider');


    if (
        videoSlider.length &&
        videoSlider.hasClass(
            'slick-initialized'
        )
    ) {

        videoSlider.slick(
            'slickPlay'
        );

    }


    /* =====================================================
       RESUME GALLERY
    ===================================================== */

    const gallerySlider =
        $('.service-gallery-slider');


    if (
        gallerySlider.length &&
        gallerySlider.hasClass(
            'slick-initialized'
        )
    ) {

        gallerySlider.slick(
            'slickPlay'
        );

    }

}


/* =========================================================
   ESC KEY
========================================================= */

document.addEventListener(
    'keydown',
    function(event) {

        if (
            event.key === 'Escape'
        ) {

            closeVideoModal();

        }

    }
);


/* =========================================================
   ENTER / SPACE VIDEO CARDS
========================================================= */

document.addEventListener(
    'keydown',
    function(event) {

        const target =
            event.target.closest(
                '.service-video-card, .main-video-card'
            );


        if (!target) {

            return;

        }


        if (
            event.key === 'Enter' ||
            event.key === ' '
        ) {

            event.preventDefault();

            target.click();

        }

    }
);


/* =========================================================
   FACTS IN NUMBERS - COUNTER
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function() {

        const factsSection =
            document.querySelector(
                '.facts-section'
            );


        if (!factsSection) {

            return;

        }


        const counters =
            factsSection.querySelectorAll(
                '.counter-number'
            );


        let hasAnimated =
            false;


        function animateCounters()
        {

            if (hasAnimated) {

                return;

            }


            hasAnimated =
                true;


            counters.forEach(
                function(counter) {

                    const target =
                        parseInt(
                            counter.getAttribute(
                                'data-target'
                            ),
                            10
                        );


                    const duration =
                        1800;


                    const startTime =
                        performance.now();


                    function updateCounter(
                        currentTime
                    )
                    {

                        const elapsed =
                            currentTime -
                            startTime;


                        const progress =
                            Math.min(
                                elapsed /
                                duration,
                                1
                            );


                        const easeOut =
                            1 -
                            Math.pow(
                                1 - progress,
                                3
                            );


                        const currentValue =
                            Math.floor(
                                easeOut *
                                target
                            );


                        counter.textContent =
                            currentValue.toLocaleString();


                        if (
                            progress < 1
                        ) {

                            requestAnimationFrame(
                                updateCounter
                            );

                        } else {

                            counter.textContent =
                                target.toLocaleString();

                        }

                    }


                    requestAnimationFrame(
                        updateCounter
                    );

                }
            );

        }


        /* =================================================
           INTERSECTION OBSERVER
        ================================================= */

        const observer =
            new IntersectionObserver(
                function(entries) {

                    entries.forEach(
                        function(entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                animateCounters();

                                observer.unobserve(
                                    factsSection
                                );

                            }

                        }
                    );

                },
                {
                    threshold: 0.25
                }
            );


        observer.observe(
            factsSection
        );

    }
);


/* =========================================================
   HERO CAROUSEL
========================================================= */

window.addEventListener(
    'load',
    function () {

        const heroCarousel =
            document.querySelector('#heroCarousel');


        if (!heroCarousel) {

            return;

        }


        const slides =
            Array.from(
                heroCarousel.querySelectorAll('.carousel-item')
            );


        if (slides.length < 2) {

            return;

        }


        let currentIndex =
            0;


        slides.forEach(function (slide, index) {

            slide.style.position = 'absolute';
            slide.style.top = '0';
            slide.style.left = '0';
            slide.style.width = '100%';
            slide.style.height = '100%';
            slide.style.transition = 'opacity 0.8s ease-in-out';
            slide.style.opacity = (index === 0) ? '1' : '0';
            slide.style.zIndex = (index === 0) ? '2' : '1';

        });


        heroCarousel
            .querySelector('.carousel-inner')
            .style.position = 'relative';


        setInterval(function () {

            slides[currentIndex].style.opacity = '0';
            slides[currentIndex].style.zIndex = '1';

            currentIndex =
                (currentIndex + 1) % slides.length;

            slides[currentIndex].style.opacity = '1';
            slides[currentIndex].style.zIndex = '2';

        }, 4000);

    }
);
