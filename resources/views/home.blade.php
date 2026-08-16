@extends('layouts.app')

@section('content')

{{-- Categories --}}
@foreach($categories as $index => $category)
    <section class="about-us section-padding">
        <div class="container">
            <div class="row">

                @if($index % 2 == 0)

                    {{-- Text Left / Image Right --}}
                    <div class="col col-md-6">
                        <div class="section-title-s1">
                            <h2>{{ $category->name }}</h2>
                        </div>

                        <div class="about-details">
                            <p>{{ $category->description }}</p>
                             <a href="{{ route('categories.index', $category->slug) }}" class="theme-btn-s1">Read Article</a>
                        </div>
                    </div>

                    <div class="col col-md-6 about-image-col">
                        <div class="img-holder">
                            @if($category->image)
                                <img
                                    src="{{ asset('uploads/categories/thumb/large/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="img img-responsive"
                                >
                            @endif
                        </div>
                    </div>

                @else

                    {{-- Image Left / Text Right --}}
                    <div class="col col-md-6 about-image-col">
                        <div class="img-holder">
                            @if($category->image)
                                <img
                                    src="{{ asset('uploads/categories/thumb/large/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="img img-responsive"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="col col-md-6">
                        <div class="section-title-s1">
                            <h2>{{ $category->name }}</h2>
                        </div>

                        <div class="about-details">
                            <p>{{ $category->description }}</p>
                            <a href="{{ route('categories.index', $category->slug) }}" class="theme-btn-s1">Read Article</a>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </section>
@endforeach


{{-- Latest Projects / Subcategories --}}
<section class="latest-projects section-padding">
    <div class="container">

        <div class="row section-title-s3">
            <div class="col col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <h2>Our latest <span>Projects</span></h2>
                <p>
                    Explore our services and solutions by category.
                    Choose a category below to view our services.
                </p>
            </div>
        </div>

        <div class="portfolio gallery-grid">
            <div class="row">

                {{-- Filter Buttons --}}
                <ul class="portfolio-sorting gallery-button list-inline text-center">
                    <li>
                        <a href="#"
                           data-group="all"
                           class="filter-btn active">
                            All
                        </a>
                    </li>

                    @foreach($categories as $category)
                        <li>
                            <a href="#"
                               data-group="category-{{ $category->id }}"
                               class="filter-btn">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- Subcategories --}}
                <div id="lightBox" class="gallery-wrapper">
                    <ul class="portfolio-items courses list-unstyled" id="grid">

                        @foreach($categories as $category)
                            @foreach($category->subCategories as $subCategory)

                                <li class="col-md-3 col-sm-6"
                                    data-groups='["category-{{ $category->id }}"]'>

                                    <figure class="portfolio-item gallery-caption grid">

                                        <div class="inner">
                                            @if($subCategory->image)
                                                <a href="{{ route('subcategory.index', $subCategory->slug) }}"
                                                   class="fancybox">
                                                    <img
                                                        src="{{ asset('uploads/sub_categories/thumb/large/' . $subCategory->image) }}"
                                                        alt="{{ $subCategory->name }}"
                                                        class="img img-responsive"
                                                    >
                                                </a>
                                            @else
                                                <a href="{{ route('subcategory.index', $subCategory->slug) }}">
                                                    <img
                                                        src="{{ asset('assets/images/latest-projects/img-1.jpg') }}"
                                                        alt="{{ $subCategory->name }}"
                                                        class="img img-responsive"
                                                    >
                                                </a>
                                            @endif
                                        </div>

                                        <div class="project-title">
                                            <h3>
                                                <a href="{{ route('subcategory.index', $subCategory->slug) }}">
                                                    {{ $subCategory->name }}
                                                </a>
                                            </h3>
                                        </div>

                                    </figure>
                                </li>

                            @endforeach
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
