@extends('layouts.app')

@section('content')

<!-- start page-title-wrapper -->
<div class="page-title">
    <div class="container">
        <h1>{{ $subCategory->name }}</h1>
    </div>
</div>
<!-- end page-title-wrapper -->


<!-- start of latest-projects -->
<section class="latest-projects section-padding">

    <div class="container">

        <div class="portfolio gallery-grid">

            <div class="row">

                @if($services->count() > 0)

                    <!-- SERVICE GRID -->
                    <div id="lightBox" class="gallery-wrapper">

                        <ul class="portfolio-items courses list-unstyled" id="grid">

                            @foreach($services as $service)

                                <li
                                    class="col-md-3 col-sm-6"
                                    data-groups='["all"]'
                                >

                                    <figure class="portfolio-item gallery-caption grid">

                                        <!-- SERVICE IMAGE -->
                                        <div class="inner">

                                            @if(!empty($service->image))

                                                <a
                                                    href="{{ route('service.detail', $service->slug) }}"
                                                    class="fancybox"
                                                >
                                                    <img
                                                        src="{{ asset('uploads/services/thumb/large/' . $service->image) }}"
                                                        alt="{{ $service->name }}"
                                                        class="img img-responsive"
                                                    >
                                                </a>

                                            @else

                                                <a  href="{{ route('service.detail', $service->slug) }}">
                                                    <img
                                                        src="{{ asset('assets/images/latest-projects/img-1.jpg') }}"
                                                        alt="{{ $service->name }}"
                                                        class="img img-responsive"
                                                    >
                                                </a>

                                            @endif

                                        </div>
                                        <!-- END SERVICE IMAGE -->


                                        <!-- SERVICE TITLE -->
                                        <div class="project-title">

                                            <h3>
                                                <a  href="{{ route('service.detail', $service->slug) }}">
                                                    {{ $service->name }}
                                                </a>
                                            </h3>

                                        </div>
                                        <!-- END SERVICE TITLE -->

                                    </figure>

                                </li>

                            @endforeach

                        </ul>
                        <!-- end portfolio grid -->

                    </div>
                    <!-- end gallery-wrapper -->


                @else

                    <!-- NO SERVICES FOUND -->

                    <div class="col-md-12 text-center">

                        <div style="padding: 80px 0;">

                            <h3>No Services Found</h3>

                            <p>
                                No services are available in
                                <strong>{{ $subCategory->name }}</strong>.
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>
<!-- end of latest-projects -->

@endsection
