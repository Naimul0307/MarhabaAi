@extends('layouts.app')

@section('content')
<!-- PAGE TITLE -->
<div class="page-title">
    <div class="container">
        <h1>Contact</h1>
    </div>
</div>
<!-- END PAGE TITLE -->
<!-- start of contact-section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col col-md-5 col-md-offset-7 col-sm-6 col-sm-offset-6">
                <div class="contact-form">
                            <h4>Send Email</h4>
                            <form class="form contact-validation-active" id="contact-form"  method="POST"  name="contactForm" action="{{ route('sendContactEmail') }}">
                               @csrf
                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Full Name" >
                                    <p class="name-error invalid-feedback"></p>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number*</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Enter your phone number">
                                    <p class="phone-error invalid-feedback"></p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address*</label>
                                    <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email">
                                    <p class="email-error invalid-feedback"></p>
                                </div>

                                <div class="form-group">
                                    <label for="textareaBox" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                                    <p class="message-error invalid-feedback"></p>
                                </div>
                                <div class="submit">
                                    <button type="submit" id="submit">Send</button>
                                    <span id="loader"><img src="{{ asset('assets/images/contact-ajax-loader.gif') }}" alt="Loader"></span>
                                </div>
                                <div class="error-handling-messages">
                                    <div id="success">Thank you</div>
                                    <div id="error"> Error occurred while sending email. Please try again later. </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
</section>
<!-- end of contact-section -->

@endsection

@push('extraJs')

<script type="text/javascript">
$(function () {
    const $form = $("#contact-form");
    const $submit = $("#submit");
    const $loader = $("#loader");

    // hide loader by default
    $loader.hide();

    $form.off("submit").on("submit", function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $submit.prop("disabled", true);
        $loader.show();

        $(".invalid-feedback").html("");
        $(".is-invalid").removeClass("is-invalid");
        $("#success").hide();
        $("#error").hide();

        $.ajax({
            url: $form.attr("action"),
            type: "POST",
            data: $form.serialize(),
            dataType: "json",
            success: function(response) {
                $submit.prop("disabled", false);
                $loader.hide();

                if (response.status == 0) {
                    if (response.errors.name) {
                        $("#name").addClass("is-invalid");
                        $(".name-error").html(response.errors.name);
                    }
                    if (response.errors.email) {
                        $("#email").addClass("is-invalid");
                        $(".email-error").html(response.errors.email);
                    }
                    if (response.errors.phone) {
                        $("#phone").addClass("is-invalid");
                        $(".phone-error").html(response.errors.phone);
                    }
                    if (response.errors.message) {
                        $("#message").addClass("is-invalid");
                        $(".message-error").html(response.errors.message);
                    }
                } else {
                    $("#success").show();
                    $form[0].reset();
                }
            },
            error: function(xhr) {
                $submit.prop("disabled", false);
                $loader.hide();
                $("#error").show();
                console.error("AJAX Error:", xhr);
            }
        });

        return false;
    });
});
</script>
@endpush

