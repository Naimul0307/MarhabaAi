document.addEventListener('DOMContentLoaded', function () {
const desktopNav = document.querySelector('.desktop-nav .nav-bar');
const mobileNav = document.querySelector('.mobile-nav .nav-bar');

function handleNavbarScroll() {
    const scrolled = window.scrollY > 50;

    if (desktopNav) {
        desktopNav.classList.toggle('scrolled', scrolled);
    }

    if (mobileNav) {
        mobileNav.classList.toggle('scrolled', scrolled);
    }
}

window.addEventListener('scroll', handleNavbarScroll, {
    passive: true
});

handleNavbarScroll();


const menuToggle = document.getElementById('menu-toggle');
const closeMenu = document.getElementById('close-menu');
const mobileMenu = document.getElementById('mobile-menu');

if (menuToggle && closeMenu && mobileMenu) {

    function closeMobileMenu() {

        mobileMenu.classList.remove('show-menu');

        menuToggle.style.display = '';
        closeMenu.style.display = '';

        menuToggle.setAttribute('aria-expanded', 'false');

        document.body.classList.remove('mobile-menu-open');

        const languageItem =
            mobileMenu.querySelector('.mobile-language-item');

        const languageToggle =
            mobileMenu.querySelector('.mobile-language-toggle');

        if (languageItem) {
            languageItem.classList.remove('open');
        }

        if (languageToggle) {
            languageToggle.setAttribute(
                'aria-expanded',
                'false'
            );
        }
    }


    menuToggle.addEventListener('click', function (e) {

        e.preventDefault();
        e.stopPropagation();

        mobileMenu.classList.add('show-menu');

        menuToggle.style.display = 'none';
        closeMenu.style.display = 'block';

        menuToggle.setAttribute(
            'aria-expanded',
            'true'
        );

        document.body.classList.add('mobile-menu-open');
    });


    closeMenu.addEventListener('click', function (e) {

        e.preventDefault();
        e.stopPropagation();

        closeMobileMenu();
    });


    document.addEventListener('click', function (e) {

        if (
            mobileMenu.classList.contains('show-menu') &&
            !e.target.closest('.mobile-nav')
        ) {
            closeMobileMenu();
        }
    });


    mobileMenu
        .querySelectorAll('a:not(.mobile-language-option)')
        .forEach(function (link) {

            link.addEventListener('click', function () {
                closeMobileMenu();
            });

        });


    document.addEventListener('keydown', function (e) {

        if (
            e.key === 'Escape' &&
            mobileMenu.classList.contains('show-menu')
        ) {
            closeMobileMenu();
            menuToggle.focus();
        }

    });


    window.addEventListener('resize', function () {

        if (
            window.innerWidth > 768 &&
            mobileMenu.classList.contains('show-menu')
        ) {
            closeMobileMenu();
        }

    });

}


const desktopLanguage =
    document.querySelector('.language-selector');

const desktopLanguageToggle =
    document.querySelector('.language-toggle');

if (desktopLanguage && desktopLanguageToggle) {

    desktopLanguageToggle.addEventListener(
        'click',
        function (e) {

            e.preventDefault();
            e.stopPropagation();

            const isOpen =
                desktopLanguage.classList.contains('open');

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


    document.addEventListener('click', function (e) {

        if (!desktopLanguage.contains(e.target)) {

            desktopLanguage.classList.remove('open');

            desktopLanguageToggle.setAttribute(
                'aria-expanded',
                'false'
            );

        }

    });

}


const mobileLanguageItem =
    document.querySelector('.mobile-language-item');

const mobileLanguageToggle =
    document.querySelector('.mobile-language-toggle');

const mobileLanguageOptions =
    document.querySelectorAll('.mobile-language-option');

if (
    mobileLanguageItem &&
    mobileLanguageToggle
) {

    mobileLanguageToggle.addEventListener(
        'click',
        function (e) {

            e.preventDefault();
            e.stopPropagation();

            const isOpen =
                mobileLanguageItem.classList.contains('open');

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


    mobileLanguageOptions.forEach(function (option) {

        option.addEventListener('click', function () {

            mobileLanguageOptions.forEach(
                function (item) {
                    item.classList.remove('active');
                }
            );

            option.classList.add('active');

            mobileLanguageItem.classList.remove('open');

            mobileLanguageToggle.setAttribute(
                'aria-expanded',
                'false'
            );

        });

    });

}
});
