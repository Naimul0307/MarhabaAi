@extends('layouts.app')

@section('content')

<!-- PAGE TITLE -->
<div class="page-title">
    <div class="container">
        <h1>{{ $category->name }}</h1>
    </div>
</div>
<!-- END PAGE TITLE -->


<!-- LATEST PROJECTS -->
<section class="latest-projects section-padding">

    <div class="container">

        <div class="portfolio gallery-grid">

            <div class="row">

                <!-- FILTER BUTTONS -->
                @if($subCategories->count() > 0)

                    <ul class="portfolio-sorting gallery-button list-inline text-center">

                        <li>
                            <a href="#"
                               data-group="all"
                               class="filter-btn active">
                                All
                            </a>
                        </li>

                        @foreach($subCategories as $subCategory)

                            <li>
                                <a href="#"
                                   data-group="subcategory-{{ $subCategory->id }}"
                                   class="filter-btn">
                                    {{ $subCategory->name }}
                                </a>
                            </li>

                        @endforeach

                    </ul>

                @endif


                <!-- SUBCATEGORY GRID -->
                <div id="lightBox" class="gallery-wrapper">

                    @if($subCategories->count() > 0)

                        <ul class="portfolio-items courses list-unstyled" id="grid">

                            @foreach($subCategories as $subCategory)

                                <li
                                    class="col-md-3 col-sm-6"
                                    data-groups='["subcategory-{{ $subCategory->id }}"]'
                                >
                                    <figure class="portfolio-item gallery-caption grid">

                                        <div class="inner">
                                            @if($subCategory->image)
                                               <a href="{{ route('subcategory.index', $subCategory->slug) }}"class="fancybox">
                                                    <img
                                                        src="{{ asset('uploads/sub_categories/thumb/large/' . $subCategory->image) }}"
                                                        alt="{{ $subCategory->name }}"
                                                        class="img img-responsive"
                                                    >
                                                </a>
                                            @else
                                               <a href="{{ route('subcategory.index', $subCategory->slug) }}" class="fancybox">
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

                        </ul>

                    @else

                        <!-- NO RECORD FOUND -->
                        <div class="text-center" style="padding: 50px 0;">

                            <h3>No Record Found</h3>

                            <p>
                                No subcategories are available for
                                <strong>{{ $category->name }}</strong>.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>
<!-- END LATEST PROJECTS -->

@endsection
