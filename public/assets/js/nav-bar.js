document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       NAVBAR SCROLL
    ========================================================= */

    const desktopNav =
        document.querySelector('.desktop-nav .nav-bar');

    const mobileNav =
        document.querySelector('.mobile-nav .nav-bar');


    function handleNavbarScroll() {

        const scrolled = window.scrollY > 50;


        /* =====================================================
           DESKTOP NAVBAR
        ===================================================== */

        if (desktopNav) {

            desktopNav.classList.toggle(
                'scrolled',
                scrolled
            );

        }


        /* =====================================================
           MOBILE NAVBAR
        ===================================================== */

        if (mobileNav) {

            mobileNav.classList.toggle(
                'scrolled',
                scrolled
            );

        }

    }


    window.addEventListener(
        'scroll',
        handleNavbarScroll,
        {
            passive: true
        }
    );


    /* Run once when page loads */

    handleNavbarScroll();



    /* =========================================================
       MOBILE MENU
    ========================================================= */

    const menuToggle =
        document.getElementById('menu-toggle');

    const closeMenu =
        document.getElementById('close-menu');

    const mobileMenu =
        document.getElementById('mobile-menu');


    if (
        menuToggle &&
        closeMenu &&
        mobileMenu
    ) {


        /* =====================================================
           CLOSE MOBILE MENU
        ===================================================== */

        function closeMobileMenu() {

            mobileMenu.classList.remove(
                'show-menu'
            );


            menuToggle.style.display = '';

            closeMenu.style.display = '';


            menuToggle.setAttribute(
                'aria-expanded',
                'false'
            );


            document.body.classList.remove(
                'mobile-menu-open'
            );


            /* =================================================
               CLOSE MOBILE LANGUAGE
            ================================================= */

            const languageItem =
                mobileMenu.querySelector(
                    '.mobile-language-item'
                );


            const languageToggle =
                mobileMenu.querySelector(
                    '.mobile-language-toggle'
                );


            if (languageItem) {

                languageItem.classList.remove(
                    'open'
                );

            }


            if (languageToggle) {

                languageToggle.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }

        }



        /* =====================================================
           OPEN MOBILE MENU
        ===================================================== */

        menuToggle.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                e.stopPropagation();


                mobileMenu.classList.add(
                    'show-menu'
                );


                menuToggle.style.display =
                    'none';


                closeMenu.style.display =
                    'block';


                menuToggle.setAttribute(
                    'aria-expanded',
                    'true'
                );


                document.body.classList.add(
                    'mobile-menu-open'
                );

            }
        );



        /* =====================================================
           CLOSE MOBILE MENU BUTTON
        ===================================================== */

        closeMenu.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                e.stopPropagation();


                closeMobileMenu();

            }
        );



        /* =====================================================
           CLICK OUTSIDE MOBILE MENU
        ===================================================== */

        document.addEventListener(
            'click',
            function (e) {

                if (
                    mobileMenu.classList.contains(
                        'show-menu'
                    ) &&
                    !e.target.closest(
                        '.mobile-nav'
                    )
                ) {

                    closeMobileMenu();

                }

            }
        );



        /* =====================================================
           CLOSE AFTER NORMAL LINK CLICK
        ===================================================== */

        mobileMenu
            .querySelectorAll(
                'a:not(.mobile-language-option)'
            )
            .forEach(
                function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            closeMobileMenu();

                        }
                    );

                }
            );



        /* =====================================================
           ESCAPE KEY
        ===================================================== */

        document.addEventListener(
            'keydown',
            function (e) {

                if (
                    e.key === 'Escape' &&
                    mobileMenu.classList.contains(
                        'show-menu'
                    )
                ) {

                    closeMobileMenu();

                    menuToggle.focus();

                }

            }
        );



        /* =====================================================
           CLOSE MOBILE MENU WHEN SWITCHING DESKTOP
        ===================================================== */

        window.addEventListener(
            'resize',
            function () {

                if (
                    window.innerWidth > 768 &&
                    mobileMenu.classList.contains(
                        'show-menu'
                    )
                ) {

                    closeMobileMenu();

                }

            }
        );

    }



    /* =========================================================
       DESKTOP LANGUAGE SELECTOR
    ========================================================= */

    const desktopLanguage =
        document.querySelector(
            '.language-selector'
        );


    const desktopLanguageToggle =
        document.querySelector(
            '.language-toggle'
        );


    if (
        desktopLanguage &&
        desktopLanguageToggle
    ) {


        /* =====================================================
           OPEN / CLOSE DESKTOP LANGUAGE
        ===================================================== */

        desktopLanguageToggle.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                e.stopPropagation();


                const isOpen =
                    desktopLanguage.classList.contains(
                        'open'
                    );


                desktopLanguage.classList.toggle(
                    'open',
                    !isOpen
                );


                desktopLanguageToggle.setAttribute(
                    'aria-expanded',
                    String(!isOpen)
                );

            }
        );



        /* =====================================================
           CLOSE DESKTOP LANGUAGE OUTSIDE CLICK
        ===================================================== */

        document.addEventListener(
            'click',
            function (e) {

                if (
                    !desktopLanguage.contains(
                        e.target
                    )
                ) {

                    desktopLanguage.classList.remove(
                        'open'
                    );


                    desktopLanguageToggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );

    }



    /* =========================================================
       MOBILE LANGUAGE SELECTOR
       CLICK ONLY
    ========================================================= */

    const mobileLanguageItem =
        document.querySelector(
            '.mobile-language-item'
        );


    const mobileLanguageToggle =
        document.querySelector(
            '.mobile-language-toggle'
        );


    const mobileLanguageOptions =
        document.querySelectorAll(
            '.mobile-language-option'
        );


    if (
        mobileLanguageItem &&
        mobileLanguageToggle
    ) {


        /* =====================================================
           OPEN / CLOSE MOBILE LANGUAGE
        ===================================================== */

        mobileLanguageToggle.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                e.stopPropagation();


                const isOpen =
                    mobileLanguageItem.classList.contains(
                        'open'
                    );


                mobileLanguageItem.classList.toggle(
                    'open',
                    !isOpen
                );


                mobileLanguageToggle.setAttribute(
                    'aria-expanded',
                    String(!isOpen)
                );

            }
        );



        /* =====================================================
           MOBILE LANGUAGE OPTION
        ===================================================== */

        mobileLanguageOptions.forEach(
            function (option) {

                option.addEventListener(
                    'click',
                    function (e) {

                        e.preventDefault();

                        e.stopPropagation();


                        /* =====================================
                           REMOVE ACTIVE
                        ===================================== */

                        mobileLanguageOptions.forEach(
                            function (item) {

                                item.classList.remove(
                                    'active'
                                );

                            }
                        );


                        /* =====================================
                           ADD ACTIVE
                        ===================================== */

                        option.classList.add(
                            'active'
                        );



                        /* =====================================
                           UPDATE CURRENT LANGUAGE
                        ===================================== */

                        const currentLanguage =
                            mobileLanguageItem.querySelector(
                                '.mobile-current-language'
                            );


                        if (currentLanguage) {

                            currentLanguage.textContent =
                                option.textContent.trim();

                        }



                        /* =====================================
                           CLOSE LANGUAGE DROPDOWN
                        ===================================== */

                        mobileLanguageItem.classList.remove(
                            'open'
                        );


                        mobileLanguageToggle.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }
                );

            }
        );

    }

});

