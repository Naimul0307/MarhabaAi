
@php
    $settings = getSettings();
    $footerCategories = getCategories();
@endphp

<footer class="footer section gray-bg" aria-label="{{ __('messages.site_footer') }}">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">

                    <h3 class="footer-heading mb-3">
                        {{ __('messages.what_we_do') }}
                    </h3>

                    <ul class="list-unstyled footer-menu lh-35">

                        @foreach($footerCategories as $category)
                            <li>
                                <a href="{{ route('category.detail', [
                                    'locale' => app()->getLocale(),
                                    'slug' => $category->category_slug
                                ]) }}">

                                    @if(app()->getLocale() === 'ar')
                                        <span dir="rtl">
                                            {{ $category->category_name_ar ?: $category->category_name }}
                                        </span>
                                    @else
                                        {{ $category->category_name }}
                                    @endif

                                </a>
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">

                    <h3 class="footer-heading mb-3">
                        {{ __('messages.quick_links') }}
                    </h3>

                    <ul class="list-unstyled footer-menu lh-35">

                        <li>
                            <a href="{{ route('home') }}">
                                {{ __('messages.the_inside') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">
                                {{ __('messages.connect') }}
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget widget-contact mb-5 mb-lg-0">

                    <h3 class="footer-heading mb-3">
                        {{ __('messages.get_in_touch') }}
                    </h3>

                    <div class="footer-contact-block mb-4">

                        @if(!empty($settings) && $settings->email)
                            <p class="footer-contact-item">
                                <i class="fa-solid fa-envelope" aria-hidden="true"></i>

                                <a
                                    class="footer-contact-link"
                                    href="mailto:{{ $settings->email }}"
                                    aria-label="{{ __('messages.email_us') }}">
                                    {{ $settings->email }}
                                </a>
                            </p>
                        @endif

                        @if(!empty($settings) && $settings->phone)
                            <p class="footer-contact-item">
                                <i class="fa-solid fa-phone" aria-hidden="true"></i>

                                <a
                                    class="footer-contact-link"
                                    href="tel:{{ $settings->phone }}"
                                    aria-label="{{ __('messages.call_us') }}">
                                    {{ $settings->phone }}
                                </a>
                            </p>
                        @endif

                    </div>

                    <ul
                        class="list-inline footer-socials mt-4"
                        aria-label="{{ __('messages.social_media_links') }}">

                        @if(!empty($settings) && $settings->facebook_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->facebook_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.visit_facebook') }}">
                                    <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                        @if(!empty($settings) && $settings->twitter_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->twitter_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.visit_twitter') }}">
                                    <i class="fa-brands fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                        @if(!empty($settings) && $settings->instagram_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->instagram_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.visit_instagram') }}">
                                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                        @if(!empty($settings) && $settings->whatsapp_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->whatsapp_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.contact_whatsapp') }}">
                                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                        @if(!empty($settings) && $settings->tiktok_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->tiktok_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.visit_tiktok') }}">
                                    <i class="fa-brands fa-tiktok" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                        @if(!empty($settings) && $settings->linkedin_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->linkedin_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.visit_linkedin') }}">
                                    <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                        @if(!empty($settings) && $settings->youtube_url)
                            <li class="list-inline-item">
                                <a
                                    href="{{ $settings->youtube_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('messages.visit_youtube') }}">
                                    <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">

                    <h3 class="footer-heading mb-3">
                        {{ __('messages.find_us') }}
                    </h3>

                    <iframe
                        class="w-100 rounded"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3612.689286854263!2d55.21748097537905!3d25.112377177765673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6cfa0d4ca90b%3A0x3587fd0f2266a3f9!2sAl%20Asayel%20St%20-%20Dubai!5e0!3m2!1sen!2sae!4v1787516976584!5m2!1sen!2sae"
                        title="{{ __('messages.marhaba_ai_location') }}"
                        height="250"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>

                </div>
            </div>

        </div>
    </div>

    <div class="footer-btm-divider"></div>

    <div class="container">

        <div class="footer-btm py-4 mt-0">

            <div class="row align-items-center justify-content-between">

                <div class="col-lg-6">

                    @if(!empty($settings) && $settings->copy)

                        <div class="copyright">

                            <a
                                href="#"
                                class="custom-link"
                                aria-label="{{ __('messages.visit_website') }}">

                                {{ $settings->copy }}

                            </a>

                        </div>

                    @endif

                </div>

            </div>

            <div class="row">

                <div class="col-lg-4">

                    <a
                        class="backtop scroll-top-to reveal"
                        href="#top"
                        aria-label="{{ __('messages.back_to_top') }}">

                        <i
                            class="icofont-long-arrow-up"
                            aria-hidden="true">
                        </i>

                    </a>

                </div>

            </div>

        </div>

    </div>
</footer>
