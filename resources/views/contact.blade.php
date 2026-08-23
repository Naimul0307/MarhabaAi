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
            <!-- LEFT SIDE: Contact info + map -->
            <div class="col col-md-7 col-sm-6">
                <div class="contact-info">
                    <h4>Get In Touch</h4>

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

                <!-- GOOGLE MAP -->
                @if($settings && $settings->google_map)
                <div class="contact-map" style="margin-top: 25px;">
                    <iframe
                        src="{{ $settings->google_map }}"
                        width="100%"
                        height="350"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                @endif
            </div>
            <!-- END LEFT SIDE -->

            <!-- RIGHT SIDE: form (unchanged, offset removed since left column now fills that space) -->
              <div class="col col-md-5 col-sm-6">
                <div class="contact-form">
                    <h4>Send Email</h4>
                    <form class="form contact-validation-active" id="contact-form" method="POST" name="contactForm" action="{{ route('sendContactEmail') }}">
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
            <!-- END RIGHT SIDE -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end of contact-section -->

@endsection
