/* =========================================================
   SLICK ACCESSIBILITY
========================================================= */

function fixSlickAccessibility(slider) {

    const focusable =
        'a[href], button, input, select, textarea, area[href], iframe, [tabindex], [contenteditable="true"], audio[controls], video[controls], summary';

    const hiddenSlides = slider.find('.slick-slide[aria-hidden="true"]');

    const visibleSlides = slider.find('.slick-slide[aria-hidden="false"]');


    /* -----------------------------------------
       Hidden slides
    ----------------------------------------- */

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


    /* -----------------------------------------
       Visible slides
    ----------------------------------------- */

    visibleSlides
        .removeAttr('tabindex inert')
        .find('[data-slick-a11y-hidden="true"]')
        .removeAttr(
            'tabindex aria-hidden data-slick-a11y-hidden'
        );
}


/* =========================================================
   RUN ACCESSIBILITY FIX
========================================================= */

function runSlickAccessibilityFix(slider) {

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
       SLICK OPTIONS
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


        /* ---------------------------------------------
           PREVIOUS ARROW
        --------------------------------------------- */

        prevArrow: `
            <button
                type="button"
                class="slick-prev"
                aria-label="Previous service">
                <i class="fa-solid fa-angle-left"></i>
            </button>
        `,


        /* ---------------------------------------------
           NEXT ARROW
        --------------------------------------------- */

        nextArrow: `
            <button
                type="button"
                class="slick-next"
                aria-label="Next service">
                <i class="fa-solid fa-angle-right"></i>
            </button>
        `,


        /* ---------------------------------------------
           RESPONSIVE
        --------------------------------------------- */

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
       INITIALIZE SLIDERS
    ===================================================== */

    const sliders = $(
        '.services-slider, .companies-slider, .reviews-slider'
    );


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


    /* =====================================================
       PAGE LOAD ACCESSIBILITY
    ===================================================== */

    window.addEventListener('load', function () {

        sliders.each(function () {

            runSlickAccessibilityFix(
                $(this)
            );

        });

    });


    /* =====================================================
       SERVICE CATEGORY FILTER
    ===================================================== */

    const serviceSlider = $('.services-slider');

    const filterButtons = $('.filter-btn');

    const categoryPageButton = $('#categoryPageButton');

    const categoryPageButtonText =
        $('#categoryPageButtonText');


    /* -----------------------------------------
       Make sure service slider exists
    ----------------------------------------- */

    if (
        !serviceSlider.length ||
        !filterButtons.length
    ) {
        return;
    }


    /* =====================================================
       CATEGORY FILTER CLICK
    ===================================================== */

    filterButtons.on('click', function (event) {

        event.preventDefault();


        const button = $(this);

        const selectedCategory =
            button.data('category');


        /* -----------------------------------------
           Active button
        ----------------------------------------- */

        filterButtons.removeClass('active');

        button.addClass('active');


        /* =================================================
           ALL SERVICES
        ================================================= */

        if (selectedCategory === 'all') {

            serviceSlider.slick(
                'slickUnfilter'
            );


            /* -------------------------------------
               Category page button
            ------------------------------------- */

            if (categoryPageButton.length) {

                categoryPageButton.attr(
                    'href',
                    $('#categoryPageButton').data(
                        'all-url'
                    ) || '/categories'
                );

            }


            if (categoryPageButtonText.length) {

                categoryPageButtonText.text(
                    'View All Categories'
                );
            }


            /* -------------------------------------
               Accessibility
            ------------------------------------- */

            runSlickAccessibilityFix(
                serviceSlider
            );


            return;
        }


        /* =================================================
           SELECTED CATEGORY
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


        /* -----------------------------------------
           Category URL
        ----------------------------------------- */

        const categoryUrl =
            button.attr('data-category-url');


        if (
            categoryUrl &&
            categoryPageButton.length
        ) {

            categoryPageButton.attr(
                'href',
                categoryUrl
            );
        }


        /* -----------------------------------------
           Category name
        ----------------------------------------- */

        const categoryName =
            $.trim(button.text());


        if (categoryPageButtonText.length) {

            categoryPageButtonText.text(
                'View ' +
                categoryName +
                ' Services'
            );
        }


        /* -----------------------------------------
           Accessibility
        ----------------------------------------- */

        setTimeout(function () {

            runSlickAccessibilityFix(
                serviceSlider
            );

        }, 50);

    });


    /* =====================================================
       CATEGORY PAGE BUTTON
    ===================================================== */

    if (categoryPageButton.length) {

        categoryPageButton.attr(
            'data-all-url',
            '/categories'
        );
    }


    /* =====================================================
       INITIAL STATE
    ===================================================== */

    const firstButton =
        $('.filter-btn.active').first();


    if (firstButton.length) {

        const initialCategory =
            firstButton.data('category');


        if (initialCategory === 'all') {

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

});


/* =========================================================
   FACTS IN NUMBERS - COUNTER
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const factsSection = document.querySelector('.facts-section');

    if (!factsSection) {
        return;
    }


    const counters = factsSection.querySelectorAll('.counter-number');

    let hasAnimated = false;


    function animateCounters() {

        if (hasAnimated) {
            return;
        }

        hasAnimated = true;


        counters.forEach(function (counter) {

            const target = parseInt(
                counter.getAttribute('data-target'),
                10
            );

            const duration = 1800;

            const startTime = performance.now();


            function updateCounter(currentTime) {

                const elapsed = currentTime - startTime;

                const progress = Math.min(
                    elapsed / duration,
                    1
                );


                /*
                 * Ease-out effect
                 * Starts fast and slows near final number
                 */
                const easeOut = 1 - Math.pow(
                    1 - progress,
                    3
                );


                const currentValue = Math.floor(
                    easeOut * target
                );


                counter.textContent = currentValue.toLocaleString();


                if (progress < 1) {

                    requestAnimationFrame(updateCounter);

                } else {

                    counter.textContent =
                        target.toLocaleString();

                }

            }


            requestAnimationFrame(updateCounter);

        });

    }


    /* =====================================================
       DETECT WHEN SECTION ENTERS VIEW
    ====================================================== */

    const observer = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {

                    animateCounters();

                    observer.unobserve(
                        factsSection
                    );

                }

            });

        },
        {
            threshold: 0.25
        }
    );


    observer.observe(factsSection);

});
