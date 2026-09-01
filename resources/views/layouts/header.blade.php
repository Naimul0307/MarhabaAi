<header>

    {{-- =========================================================
        DESKTOP NAVIGATION
    ========================================================== --}}

    <nav class="desktop-nav" aria-label="Desktop navigation">

        <div class="nav-bar">

            {{-- =====================================================
                LOGO
            ====================================================== --}}

            <div class="logo">

                <a href="{{ route('home') }}">

                    <img
                        src="{{ asset('assets/logo.png') }}"
                        alt="Marhaba AI"
                        class="logo-img"
                        width="160"
                        height="auto">

                </a>

            </div>


            {{-- =====================================================
                DESKTOP MENU
            ====================================================== --}}

            <ul class="menu" role="list">

                {{-- THE INSIDE --}}

                <li>

                    <a
                        href="{{ route('home') }}"
                        @if(request()->routeIs('home'))
                            aria-current="page"
                        @endif>

                        THE INSIDE

                    </a>

                </li>


                {{-- WHAT WE DO --}}

                <li>

                    <a
                        href="{{ route('categories.index') }}"
                        @if(request()->routeIs('categories.index'))
                            aria-current="page"
                        @endif>

                        WHAT WE DO

                    </a>

                </li>


                {{-- CONNECT --}}

                <li>

                    <a
                        href="{{ route('contact') }}"
                        @if(request()->routeIs('contact'))
                            aria-current="page"
                        @endif>

                        CONNECT

                    </a>

                </li>

            </ul>


            {{-- =====================================================
                LANGUAGE
            ====================================================== --}}

            <div class="language-selector">

                <button
                    type="button"
                    class="language-toggle"
                    aria-label="Select language"
                    aria-expanded="false">

                    <i class="fas fa-globe"></i>

                    <span>
                        EN
                    </span>

                    <i class="fas fa-chevron-down language-arrow"></i>

                </button>


                <div class="language-dropdown">

                    <a
                        href="#"
                        class="language-option active">

                        English

                    </a>


                    <a
                        href="#"
                        class="language-option">

                        العربية

                    </a>

                </div>

            </div>

        </div>

    </nav>



    {{-- =========================================================
        MOBILE NAVIGATION
    ========================================================== --}}

    <nav
        class="mobile-nav"
        aria-label="Mobile navigation">

        <div class="nav-bar">

            {{-- =================================================
                MOBILE LOGO
            ================================================== --}}

            <div class="logo">

                <a href="{{ route('home') }}">

                    <img
                        src="{{ asset('assets/logo.png') }}"
                        alt="Marhaba AI"
                        class="logo-img"
                        width="160"
                        height="auto">

                </a>

            </div>


            {{-- =================================================
                OPEN MENU BUTTON
            ================================================== --}}

            <button
                class="menu-toggle"
                id="menu-toggle"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
                type="button">

                <i
                    class="fas fa-bars"
                    aria-hidden="true">
                </i>

            </button>


            {{-- =================================================
                CLOSE MENU BUTTON
            ================================================== --}}

            <button
                class="close-menu"
                id="close-menu"
                aria-label="Close menu"
                type="button">

                <i
                    class="fas fa-times"
                    aria-hidden="true">
                </i>

            </button>

        </div>


        {{-- =====================================================
            MOBILE SIDEBAR
        ====================================================== --}}

        <ul
            class="menu"
            id="mobile-menu"
            role="list">


            {{-- =================================================
                THE INSIDE
            ================================================== --}}

            <li>

                <a
                    href="{{ route('home') }}"
                    @if(request()->routeIs('home'))
                        aria-current="page"
                    @endif>

                    THE INSIDE

                </a>

            </li>


            {{-- =================================================
                WHAT WE DO
            ================================================== --}}

            <li>

                <a
                    href="{{ route('categories.index') }}"
                    @if(request()->routeIs('categories.index'))
                        aria-current="page"
                    @endif>

                    WHAT WE DO

                </a>

            </li>


            {{-- =================================================
                CONNECT
            ================================================== --}}

            <li>

                <a
                    href="{{ route('contact') }}"
                    @if(request()->routeIs('contact'))
                        aria-current="page"
                    @endif>

                    CONNECT

                </a>

            </li>


            {{-- =================================================
                MOBILE LANGUAGE
            ================================================== --}}

            <li class="mobile-language-item">

                <button
                    type="button"
                    class="mobile-language-toggle"
                    aria-expanded="false">

                    <span>

                        <i class="fas fa-globe"></i>

                        <span class="mobile-current-language">
                            English
                        </span>

                    </span>

                    <i class="fas fa-chevron-down mobile-language-arrow"></i>

                </button>


                <div class="mobile-language-dropdown">

                    <a
                        href="#"
                        class="mobile-language-option active">

                        English

                    </a>


                    <a
                        href="#"
                        class="mobile-language-option">

                        العربية

                    </a>

                </div>

            </li>

        </ul>

    </nav>

</header>
