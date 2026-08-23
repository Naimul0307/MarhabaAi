document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       NAVBAR SCROLL
    ========================================================= */

    const desktopNav = document.querySelector('.desktop-nav .nav-bar');
    const mobileNav  = document.querySelector('.mobile-nav .nav-bar');

    function handleNavbarScroll() {
        const scrolled = window.scrollY > 50;

        if (desktopNav) {
            desktopNav.classList.toggle('scrolled', scrolled);
        }

        if (mobileNav) {
            mobileNav.classList.toggle('scrolled', scrolled);
        }
    }

    window.addEventListener('scroll', handleNavbarScroll);

    // Run once on page load
    handleNavbarScroll();


    /* =========================================================
       MOBILE MENU
    ========================================================= */

    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu  = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && closeMenu && mobileMenu) {

        const closeMobileMenu = function () {

            mobileMenu.classList.remove('show-menu');

            menuToggle.style.display = '';
            closeMenu.style.display = '';

            menuToggle.setAttribute('aria-expanded', 'false');

            document.body.classList.remove('mobile-menu-open');

            // Also close mobile dropdowns
            mobileMenu.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                menu.classList.remove('show');
            });

            mobileMenu.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            });
        };


        /* ─────────────────────────────────────
           OPEN MOBILE MENU
        ───────────────────────────────────── */

        menuToggle.addEventListener('click', function (e) {

            e.stopPropagation();

            mobileMenu.classList.add('show-menu');

            menuToggle.style.display = 'none';

            closeMenu.style.display = 'block';

            menuToggle.setAttribute('aria-expanded', 'true');

            document.body.classList.add('mobile-menu-open');
        });


        /* ─────────────────────────────────────
           CLOSE MOBILE MENU
        ───────────────────────────────────── */

        closeMenu.addEventListener('click', function (e) {

            e.stopPropagation();

            closeMobileMenu();
        });


        /* ─────────────────────────────────────
           CLICK OUTSIDE MOBILE MENU
        ───────────────────────────────────── */

        document.addEventListener('click', function (e) {

            if (
                mobileMenu.classList.contains('show-menu') &&
                !e.target.closest('.mobile-nav')
            ) {
                closeMobileMenu();
            }

        });


        /* ─────────────────────────────────────
           CLOSE MENU WHEN LINK IS CLICKED
        ───────────────────────────────────── */

        mobileMenu
            .querySelectorAll('a:not(.dropdown-toggle)')
            .forEach(function (link) {

                link.addEventListener('click', function () {
                    closeMobileMenu();
                });

            });


        /* ─────────────────────────────────────
           ESCAPE KEY
        ───────────────────────────────────── */

        document.addEventListener('keydown', function (e) {

            if (
                e.key === 'Escape' &&
                mobileMenu.classList.contains('show-menu')
            ) {

                closeMobileMenu();

                menuToggle.focus();
            }

        });


        /* ─────────────────────────────────────
           CLOSE MOBILE MENU WHEN SWITCHING
           TO DESKTOP
        ───────────────────────────────────── */

        window.addEventListener('resize', function () {

            // CSS switches at 768px
            if (
                window.innerWidth > 768 &&
                mobileMenu.classList.contains('show-menu')
            ) {
                closeMobileMenu();
            }

        });

    }


    /* =========================================================
       SEARCH TOGGLE
    ========================================================= */

    document
        .querySelectorAll('.search-form')
        .forEach(function (form) {

            const btn =
                form.querySelector('.search-icon-btn');

            const input =
                form.querySelector('.search-input');

            const submit =
                form.querySelector('.search-submit-btn');


            if (!btn || !input || !submit) {
                return;
            }


            /* ─────────────────────────────────
               TOGGLE SEARCH
            ───────────────────────────────── */

            btn.addEventListener('click', function (e) {

                e.preventDefault();

                e.stopPropagation();

                const isHidden =
                    input.hasAttribute('hidden');


                if (isHidden) {

                    input.removeAttribute('hidden');

                    submit.removeAttribute('hidden');

                    btn.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                    input.focus();

                } else {

                    input.setAttribute('hidden', '');

                    submit.setAttribute('hidden', '');

                    btn.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            });


            /* ─────────────────────────────────
               CLOSE SEARCH OUTSIDE
            ───────────────────────────────── */

            document.addEventListener('click', function (e) {

                if (!form.contains(e.target)) {

                    input.setAttribute('hidden', '');

                    submit.setAttribute('hidden', '');

                    btn.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            });

        });


});
