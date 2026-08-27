<header>

    {{-- =========================================================
        DESKTOP NAVIGATION
    ========================================================== --}}
    <nav class="desktop-nav" aria-label="Desktop navigation">

        <div class="nav-bar">

            {{-- LOGO --}}
            <div class="logo">
                <a href="{{ route('home') }}">

                    {{-- Default logo --}}
                    <img
                        src="{{ asset('assets/logo.png') }}"
                        alt="Marhaba AI"
                        class="logo-img logo-default"
                        width="160"
                        height="auto">

                    {{-- Scrolled logo --}}
                    <img
                        src="{{ asset('assets/logo-scroll.png') }}"
                        alt="Marhaba AI"
                        class="logo-img logo-scrolled"
                        width="160"
                        height="auto">

                </a>
            </div>

            {{-- SETTINGS --}}
            @php
                $settings = getSettings();
            @endphp


            {{-- CONTACT --}}
            <div class="nav-contact">

                @if(!empty($settings) && $settings->email)

                    <a
                        href="mailto:{{ $settings->email }}"
                        aria-label="Email us">

                        <i
                            class="fa fa-envelope"
                            aria-hidden="true">
                        </i>

                        <span>{{ $settings->email }}</span>

                    </a>

                @endif


                @if(!empty($settings) && $settings->phone)

                    <a
                        href="tel:{{ $settings->phone }}"
                        aria-label="Call us">

                        <i
                            class="fa fa-volume-control-phone"
                            aria-hidden="true">
                        </i>

                        <span>{{ $settings->phone }}</span>

                    </a>

                @endif

            </div>


            {{-- DESKTOP MENU --}}
            <ul class="menu" role="list">

                <li>

                    <a
                        href="{{ route('home') }}"
                        @if(request()->routeIs('home'))
                            aria-current="page"
                        @endif>

                        THE INSIDE

                    </a>

                </li>


                <li>

                    <a
                        href="{{ route('categories.index') }}"
                        @if(request()->routeIs('categories.index'))
                            aria-current="page"
                        @endif>

                        WHAT WE DO

                    </a>

                </li>


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


            {{-- LANGUAGE --}}
            <div class="language-selector">

                <button
                    type="button"
                    class="language-toggle"
                    aria-label="Select language"
                    aria-expanded="false">

                    <i class="fas fa-globe"></i>

                    <span>EN</span>

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
    <nav class="mobile-nav" aria-label="Mobile navigation">

        <div class="nav-bar">

            {{-- MOBILE LOGO --}}
            <div class="logo">
                <a href="{{ route('home') }}">

                    {{-- Default logo --}}
                    <img
                        src="{{ asset('assets/logo.png') }}"
                        alt="Marhaba AI"
                        class="logo-img logo-default"
                        width="160"
                        height="auto">

                    {{-- Scrolled logo --}}
                    <img
                        src="{{ asset('assets/logo-scroll.png') }}"
                        alt="Marhaba AI"
                        class="logo-img logo-scrolled"
                        width="160"
                        height="auto">

                </a>
            </div>


            {{-- OPEN BUTTON --}}
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


            {{-- CLOSE BUTTON --}}
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


        {{-- MOBILE SIDEBAR --}}
        <ul
            class="menu"
            id="mobile-menu"
            role="list">


            {{-- EMAIL --}}
            @if(!empty($settings) && $settings->email)

                <li>

                    <a
                        href="mailto:{{ $settings->email }}"
                        aria-label="Email us">

                        <span>
                            {{ $settings->email }}
                        </span>

                        <i
                            class="fa fa-envelope"
                            aria-hidden="true">
                        </i>

                    </a>

                </li>

            @endif


            {{-- PHONE --}}
            @if(!empty($settings) && $settings->phone)

                <li>

                    <a
                        href="tel:{{ $settings->phone }}"
                        aria-label="Call us">

                        <span>
                            {{ $settings->phone }}
                        </span>

                        <i
                            class="fa fa-volume-control-phone"
                            aria-hidden="true">
                        </i>

                    </a>

                </li>

            @endif


            {{-- HOME --}}
            <li>

                <a
                    href="{{ route('home') }}"
                    @if(request()->routeIs('home'))
                        aria-current="page"
                    @endif>

                    THE INSIDE

                </a>

            </li>


            {{-- SERVICES --}}
            <li>

                <a
                    href="{{ route('categories.index') }}"
                    @if(request()->routeIs('categories.index'))
                        aria-current="page"
                    @endif>

                    WHAT WE DO

                </a>

            </li>


            {{-- CONTACT --}}
            <li>

                <a
                    href="{{ route('contact') }}"
                    @if(request()->routeIs('contact'))
                        aria-current="page"
                    @endif>

                    CONNECT

                </a>

            </li>


            {{-- MOBILE LANGUAGE --}}
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
