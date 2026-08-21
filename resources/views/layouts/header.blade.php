        <!-- Start header -->
        <header class="site-header header-style-1">
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col col-sm-6 contact-info">
                            <ul>
                                <li>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    {{ $settings->email }}
                                </li>

                                <li>
                                    <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                    {{ $settings->phone }}
                                </li>
                            </ul>
                        </div>
                        <div class="col col-sm-6 language-login-wrapper">
                            <div class="language-login clearfix">
                                <div class="language">
                                    <i class="fa fa-globe" aria-hidden="true"></i> Lang:
                                    <form>
                                        <select class="selectpicker">
                                            <option>ENG</option>
                                            <option>TUK</option>
                                            <option>SPH</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end topbar -->

            <nav class="navigation navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt></a>
                    </div>

                    <div id="navbar" class="navbar-collapse collapse navbar-right navigation-holder">
                        <button class="close-navbar"><i class="fa fa-close"></i></button>
                        <ul class="nav navbar-nav">
                            <li class="menu-item-has-children current-menu-ancestor current-menu-parent">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            {{-- <li><a href="about.html">About</a></li> --}}
                            <li class="menu-item-has-children">

                                @if(isset($isCategoryPage) && $isCategoryPage)

                                    {{-- CATEGORY PAGE --}}
                                    <a href="{{ route('categories.index', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>

                                    <ul class="sub-menu">

                                        @forelse($category->subCategories as $subCategory)

                                            <li>
                                                <a href="{{ route('subcategory.index', $subCategory->slug) }}">
                                                    {{ $subCategory->name }}
                                                </a>
                                            </li>

                                        @empty

                                            <li>
                                                <a href="#">
                                                    No subcategories
                                                </a>
                                            </li>

                                        @endforelse

                                    </ul>

                                @else

                                    {{-- HOME PAGE --}}
                                    <a>Projects</a>

                                    <ul class="sub-menu">

                                        @foreach($categories as $item)

                                            <li>
                                                <a href="{{ route('categories.index', $item->slug) }}">
                                                    {{ $item->name }}
                                                </a>
                                            </li>

                                        @endforeach

                                    </ul>

                                @endif

                            </li>
                            {{-- <li class="menu-item-has-children">
                                <a href="#">Blog</a>
                            </li> --}}
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div><!-- end of nav-collapse -->

                    <div class="social-links-holder">
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
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->
