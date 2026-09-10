@extends('layouts.app')

@section('content')

<section class="about-section py-5">
    <div class="container py-2">
        <div class="about-block">
            <h1 class="title-color">
                {{ __('messages.lets') }}<span>{{ __('messages.connect') }}</span>
            </h1>

        <div class="divider-container">
            <div class="divider mb-3"></div>
        </div>

        <div class="text-muted">
            {{ __('messages.contact_intro') }}
            <br>
            — {{ __('messages.helping_brands_grow') }}
        </div>
    </div>
</div>

</section>

<section class="contact-section">
    <div class="container">
        <div class="row">

        <div class="col col-md-7 col-sm-6">
            <div class="contact-info">
                <h4>{{ __('messages.get_in_touch') }}</h4>

                @if($settings)

                    @if($settings->contact_card_one)
                        <div class="info-item">
                            {!! $settings->contact_card_one !!}
                        </div>
                    @endif

                    @if($settings->contact_card_two)
                        <div class="info-item">
                            {!! $settings->contact_card_two !!}
                        </div>
                    @endif

                @endif
            </div>

            <div class="contact-map" style="margin-top: 25px;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3612.689286854263!2d55.21748097537905!3d25.112377177765673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6cfa0d4ca90b%3A0x3587fd0f2266a3f9!2sAl%20Asayel%20St%20-%20Dubai!5e0!3m2!1sen!2sae!4v1787516976584!5m2!1sen!2sae"
                    width="100%"
                    height="350"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="col col-md-5 col-sm-6">
            <div class="contact-form">
                <h4>{{ __('messages.send_email') }}</h4>

                <div
                    id="contactStatus"
                    class="contact-status"
                    role="alert">
                </div>

                <form
                    class="form contact-validation-active"
                    id="contact-form"
                    method="POST"
                    name="contactForm"
                    action="{{ route('sendContactEmail') }}"
                >
                    @csrf

                    <div class="form-group">
                        <label for="name">
                            {{ __('messages.name') }}*
                        </label>

                        <input
                            class="form-control"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="{{ __('messages.full_name') }}"
                        >

                        <p class="name-error invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <label for="phone">
                            {{ __('messages.phone_number') }}*
                        </label>

                        <input
                            class="form-control"
                            id="phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            placeholder="{{ __('messages.enter_phone_number') }}"
                        >

                        <p class="phone-error invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            {{ __('messages.email_address') }}*
                        </label>

                        <input
                            class="form-control"
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('messages.email') }}"
                        >

                        <p class="email-error invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">
                            {{ __('messages.message') }} *
                        </label>

                        <textarea
                            class="form-control"
                            id="message"
                            name="message"
                            rows="4"
                            placeholder="{{ __('messages.write_message') }}"
                        ></textarea>

                        <p class="message-error invalid-feedback"></p>
                    </div>

                    <div class="submit">
                        <button type="submit" id="submit">
                            <span class="submit-text">
                                {{ __('messages.send') }}
                            </span>

                            <span
                                class="submit-loader"
                                aria-hidden="true">
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

</section>

<div class="services-section-divider"></div>

@endsection

@push('extraJs')

<script>
$(document).ready(function () {

    const $form = $("#contact-form");
    const $submit = $("#submit");
    const $status = $("#contactStatus");

    const translations = {
        send: @json(__('messages.send')),
        sending: @json(__('messages.sending')),
        success: @json(__('messages.contact_success')),
        error: @json(__('messages.contact_error'))
    };

    if (!$form.length) {
        return;
    }

    function setLoading(isLoading) {
        $submit.prop("disabled", isLoading);
        $submit.toggleClass("is-loading", isLoading);

        $submit
            .find(".submit-text")
            .text(isLoading ? translations.sending : translations.send);
    }

    $form.on("submit", function (event) {

        event.preventDefault();

        setLoading(true);

        $(".invalid-feedback").html("");
        $(".is-invalid").removeClass("is-invalid");

        $status
            .removeClass("success error")
            .hide()
            .text("");

        $.ajax({
            url: $form.attr("action"),
            type: "POST",
            data: $form.serialize(),
            dataType: "json",
            timeout: 0,

            success: function (response) {

                if (response.status == 0) {

                    setLoading(false);

                    if (response.errors && response.errors.name) {
                        $("#name").addClass("is-invalid");
                        $(".name-error").html(
                            response.errors.name[0]
                        );
                    }

                    if (response.errors && response.errors.email) {
                        $("#email").addClass("is-invalid");
                        $(".email-error").html(
                            response.errors.email[0]
                        );
                    }

                    if (response.errors && response.errors.phone) {
                        $("#phone").addClass("is-invalid");
                        $(".phone-error").html(
                            response.errors.phone[0]
                        );
                    }

                    if (response.errors && response.errors.message) {
                        $("#message").addClass("is-invalid");
                        $(".message-error").html(
                            response.errors.message[0]
                        );
                    }

                    return;
                }

                if (response.status == 200) {

                    setLoading(false);

                    $status
                        .removeClass("error")
                        .addClass("success")
                        .text("✓ " + translations.success)
                        .fadeIn();

                    $form[0].reset();
                }
            },

            error: function (xhr) {

                setLoading(false);

                let errorMessage = translations.error;

                if (xhr.responseJSON) {

                    if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    if (xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                }

                $status
                    .removeClass("success")
                    .addClass("error")
                    .text(errorMessage)
                    .fadeIn();
            }
        });
    });

});
</script>

@endpush
