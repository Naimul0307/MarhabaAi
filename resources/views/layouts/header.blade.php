@php
$currentRoute = request()->route();
$currentRouteName = $currentRoute?->getName();
$currentRouteParameters = $currentRoute?->parameters() ?? [];


$englishUrl = $currentRouteName
    ? route(
        $currentRouteName,
        array_merge($currentRouteParameters, ['locale' => 'en'])
    )
    : url('/en');

$arabicUrl = $currentRouteName
    ? route(
        $currentRouteName,
        array_merge($currentRouteParameters, ['locale' => 'ar'])
    )
    : url('/ar');


@endphp

<header>

<nav class="desktop-nav" aria-label="{{ __('messages.desktop_navigation') }}">
    <div class="nav-bar">


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

    <ul class="menu" role="list">

        <li>
            <a
                href="{{ route('home') }}"
                @if(request()->routeIs('home')) aria-current="page" @endif>
                {{ __('messages.the_inside') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('categories.index') }}"
                @if(request()->routeIs('categories.index')) aria-current="page" @endif>
                {{ __('messages.what_we_do') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('contact') }}"
                @if(request()->routeIs('contact')) aria-current="page" @endif>
                {{ __('messages.connect') }}
            </a>
        </li>

    </ul>

    <div class="language-selector">

        <button
            type="button"
            class="language-toggle"
            aria-label="{{ __('messages.select_language') }}"
            aria-expanded="false">

            <i class="fas fa-globe" aria-hidden="true"></i>

            <span>
                {{ app()->getLocale() === 'ar' ? 'AR' : 'EN' }}
            </span>

            <i
                class="fas fa-chevron-down language-arrow"
                aria-hidden="true">
            </i>

        </button>

        <div class="language-dropdown">

            <a
                href="{{ $englishUrl }}"
                class="language-option {{ app()->getLocale() === 'en' ? 'active' : '' }}">
                {{ __('messages.english') }}
            </a>

            <a
                href="{{ $arabicUrl }}"
                class="language-option {{ app()->getLocale() === 'ar' ? 'active' : '' }}">
                {{ __('messages.arabic') }}
            </a>

        </div>

    </div>

</div>


</nav>

<nav
    class="mobile-nav"
    aria-label="{{ __('messages.mobile_navigation') }}">


<div class="nav-bar">

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

    <button
        class="menu-toggle"
        id="menu-toggle"
        type="button"
        aria-label="{{ __('messages.open_menu') }}"
        aria-expanded="false"
        aria-controls="mobile-menu">

        <i class="fas fa-bars" aria-hidden="true"></i>

    </button>

    <button
        class="close-menu"
        id="close-menu"
        type="button"
        aria-label="{{ __('messages.close_menu') }}">

        <i class="fas fa-times" aria-hidden="true"></i>

    </button>

</div>

<ul
    class="menu"
    id="mobile-menu"
    role="list">

    <li>
        <a
            href="{{ route('home') }}"
            @if(request()->routeIs('home')) aria-current="page" @endif>
            {{ __('messages.the_inside') }}
        </a>
    </li>

    <li>
        <a
            href="{{ route('categories.index') }}"
            @if(request()->routeIs('categories.index')) aria-current="page" @endif>
            {{ __('messages.what_we_do') }}
        </a>
    </li>

    <li>
        <a
            href="{{ route('contact') }}"
            @if(request()->routeIs('contact')) aria-current="page" @endif>
            {{ __('messages.connect') }}
        </a>
    </li>

    <li class="mobile-language-item">

        <button
            type="button"
            class="mobile-language-toggle"
            aria-label="{{ __('messages.select_language') }}"
            aria-expanded="false">

            <span>

                <i class="fas fa-globe" aria-hidden="true"></i>

                <span class="mobile-current-language">
                    {{ app()->getLocale() === 'ar'
                        ? __('messages.arabic')
                        : __('messages.english') }}
                </span>

            </span>

            <i
                class="fas fa-chevron-down mobile-language-arrow"
                aria-hidden="true">
            </i>

        </button>

        <div class="mobile-language-dropdown">

            <a
                href="{{ $englishUrl }}"
                class="mobile-language-option {{ app()->getLocale() === 'en' ? 'active' : '' }}">
                {{ __('messages.english') }}
            </a>

            <a
                href="{{ $arabicUrl }}"
                class="mobile-language-option {{ app()->getLocale() === 'ar' ? 'active' : '' }}">
                {{ __('messages.arabic') }}
            </a>

        </div>

    </li>

</ul>


</nav>

</header>
