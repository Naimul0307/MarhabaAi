@if($reviews->isNotEmpty())

<section class="section-8 py-5">

    <div class="container">

        <h2 class="title-color mb-4">
            OUR <span>TESTIMONIALS</span>
        </h2>

        <div class="divider-container">
            <div class="divider mb-3"></div>
        </div>

        <div class="reviews-slider-wrapper">

            <div class="reviews-slider">

                @foreach($reviews as $review)

                    <div class="review-slide">

                        <div class="google-review-card">

                            <div class="google-review-author">

                                @if($review->image)

                                    <img
                                        src="{{ asset('uploads/reviews/' . $review->image) }}"
                                        alt="{{ $review->name }}"
                                        width="48"
                                        height="48"
                                        loading="lazy">

                                @else

                                    <div
                                        class="google-review-avatar"
                                        aria-hidden="true">

                                        {{ strtoupper(mb_substr($review->name, 0, 1)) }}

                                    </div>

                                @endif

                                <div>

                                    <strong>
                                        {{ $review->name }}
                                    </strong>

                                    @if($review->review_date)

                                        <small>
                                            {{ $review->review_date->format('M d, Y') }}
                                        </small>

                                    @endif

                                </div>

                            </div>

                            <div
                                class="google-review-stars"
                                aria-label="{{ $review->rating }} out of 5 stars">

                                @for($i = 1; $i <= 5; $i++)

                                    @if($i <= $review->rating)

                                        <i class="fa-solid fa-star"></i>

                                    @else

                                        <span>
                                            <i class="fa-regular fa-star"></i>
                                        </span>

                                    @endif

                                @endfor

                            </div>

                            <p>
                                {{ $review->review }}
                            </p>

                            @if($review->review_date)

                                <time datetime="{{ $review->review_date->format('Y-m-d') }}">
                                    {{ $review->review_date->format('M d, Y') }}
                                </time>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>

@endif
