<header>

    {{-- =========================
        DESKTOP NAVIGATION
    ========================== --}}
    <nav class="desktop-nav" aria-label="Desktop navigation">
        <div class="nav-bar">

            {{-- Logo --}}
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo.png') }}"
                         alt="Mirror Booth Dubai Logo"
                         class="logo-img"
                         width="220">
                </a>
            </div>

            @php
                $settings = getSettings();
            @endphp

            {{-- Contact information --}}
            <div class="nav-contact">

                @if(!empty($settings) && $settings->email)
                    <a href="mailto:{{ $settings->email }}"
                       aria-label="Email us">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>{{ $settings->email }}</span>
                    </a>
                @endif

                @if(!empty($settings) && $settings->phone)
                    <a href="tel:{{ $settings->phone }}"
                       aria-label="Call us">
                        <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                        <span>{{ $settings->phone }}</span>
                    </a>
                @endif

            </div>

            {{-- Desktop menu --}}
            <ul class="menu" role="list">

                <li>
                    <a href="{{ route('home') }}"
                       @if(request()->routeIs('home')) aria-current="page" @endif>
                        THE INSIDE
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"
                    @if(request()->routeIs('categories.index')) aria-current="page" @endif>
                        WHAT WE DO
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                       @if(request()->routeIs('contact')) aria-current="page" @endif>
                        CONNECT
                    </a>
                </li>

            </ul>

        </div>
    </nav>


    {{-- =========================
        MOBILE NAVIGATION
    ========================== --}}
    <nav class="mobile-nav" aria-label="Mobile navigation">

        <div class="nav-bar">

            {{-- Mobile logo --}}
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo.png') }}"
                         alt="Marhaba Ai"
                         class="logo-img"
                         width="160">
                </a>
            </div>

            {{-- Mobile menu buttons --}}
            <button
                class="menu-toggle"
                id="menu-toggle"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
                type="button">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>

            <button
                class="close-menu"
                id="close-menu"
                aria-label="Close menu"
                type="button">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>

        </div>


        {{-- Mobile sidebar --}}
        <ul class="menu" id="mobile-menu" role="list">

            {{-- Mobile contact information --}}
            <li>
                @if(!empty($settings) && $settings->email)
                    <a href="mailto:{{ $settings->email }}"
                       aria-label="Email us">
                        <span>{{ $settings->email }}</span>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </a>
                @endif
            </li>
            <li>
                @if(!empty($settings) && $settings->phone)
                    <a href="tel:{{ $settings->phone }}"
                       aria-label="Call us">
                        <span>{{ $settings->phone }}</span>
                        <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                    </a>
                @endif

            </li>


            {{-- THE INSIDE --}}
            <li>
                <a href="{{ route('home') }}"
                   @if(request()->routeIs('home')) aria-current="page" @endif>
                    THE INSIDE
                </a>
            </li>


            {{-- WHAT WE DO --}}
            <li>
                <a href="{{ route('categories.index') }}"
                @if(request()->routeIs('categories.index')) aria-current="page" @endif>
                    WHAT WE DO
                </a>
            </li>
            {{-- CONNECT --}}
            <li>
                <a href="{{ route('contact') }}"
                   @if(request()->routeIs('contact')) aria-current="page" @endif>
                    CONNECT
                </a>
            </li>

        </ul>

    </nav>

</header>
