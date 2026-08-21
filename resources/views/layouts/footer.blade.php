
        <!-- start footer-->
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-4 col-md-3 col-xs-6">
                        <div class="widget about-widget">
                            <h3><a href="#" class="logo">OUR MISSION</a></h3>
                            <p>We're on a mission to transform the brand marketing landscape with groundbreaking technologies that ignite the imagination!</p>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-3 col-xs-6">
                        <div class="widget about-widget">
                            <h3><a href="#" class="logo">OUR SOLUTIONS</a></h3>
                            <p>Tech shop for brands & advertising agencies exploring new-age activations & seamless AI-powered insights</p>
                        </div>
                    </div>
                    <div class="col col-lg-2 col-md-3 col-xs-6">
                        <div class="widget site-map-widget">
                            <h3>Navigation</h3>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li><a href="#">About</a></li> --}}
                                <li><a href="{{ route('contact') }}">Contuct</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col col-lg-3 col-md-3 col-xs-6">
                        <div class="widget social-media-widget">
                            <ul class="social-links">

                                @if(!empty($settings->facebook_url))
                                    <li>
                                        <a href="{{ $settings->facebook_url }}" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($settings->twitter_url))
                                    <li>
                                        <a href="{{ $settings->twitter_url }}" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($settings->linkedin_url))
                                    <li>
                                        <a href="{{ $settings->linkedin_url }}" target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($settings->instagram_url))
                                    <li>
                                        <a href="{{ $settings->instagram_url }}" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($settings->youtube_url))
                                    <li>
                                        <a href="{{ $settings->youtube_url }}" target="_blank">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($settings->tiktok_url))
                                    <li>
                                        <a href="{{ $settings->tiktok_url }}" target="_blank">
                                            <i class="fa fa-music"></i>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </footer>
        <!-- end footer-->
