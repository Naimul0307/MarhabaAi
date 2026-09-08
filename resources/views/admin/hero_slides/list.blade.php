@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Hero Slides / List</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            Home
                        </a>
                    </li>
                </ol>
            </div>

        </div>
    </div>
</div>

<!-- Main Content -->
<section class="content h-100">
    <div class="container-fluid h-100">

        <div class="row">
            <div class="col-md-12">

                {{-- Success Message --}}
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                {{-- Error Message --}}
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <div class="card">

                    <!-- Card Header -->
                    <div class="card-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <!-- Create Button -->
                            <div class="card-title mb-0">
                                <a href="{{ route('heroSlide.create') }}"
                                   class="btn btn-primary">
                                    Create
                                </a>
                            </div>

                            <!-- Right Side -->
                            <div class="d-flex align-items-center">

                                <!-- Language Selector -->
                                <div class="mr-2">
                                    <select id="languageSelector"
                                            class="form-control"
                                            style="width: 150px;">

                                        <option value="en">
                                            English
                                        </option>

                                        <option value="ar">
                                            العربية
                                        </option>

                                    </select>
                                </div>

                                <!-- Search -->
                                <div class="card-tools">

                                    <form action="" method="get">

                                        <div class="input-group mb-0"
                                             style="width: 500px;">

                                            <input
                                                type="text"
                                                name="keyword"
                                                value="{{ request()->get('keyword') }}"
                                                class="form-control"
                                                placeholder="Search">

                                            <select name="heroSlides"
                                                    class="form-control">

                                                <option value="">
                                                    All Hero Slides
                                                </option>

                                                @foreach($heroSlides as $heroSlide)

                                                    <option
                                                        value="{{ $heroSlide->id }}"
                                                        {{ request()->get('heroSlides') == $heroSlide->id ? 'selected' : '' }}>

                                                        {{ $heroSlide->name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                            <div class="input-group-append">

                                                <button type="submit"
                                                        class="btn btn-default">

                                                    <i class="fas fa-search"></i>

                                                </button>

                                            </div>

                                            <a href="{{ route('heroSlideList') }}"
                                               class="btn btn-secondary ml-2">

                                                Reset

                                            </a>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Table -->
                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover mb-0"
                               id="heroSlideTable">

                            <thead>
                                <tr>

                                    <th width="70">
                                        ID
                                    </th>

                                    <th class="en-column">
                                        English Name
                                    </th>

                                    <th class="ar-column"
                                        dir="rtl">
                                        اسم الشريحة
                                    </th>

                                    <th>
                                        Slug
                                    </th>

                                    <th>
                                        Image
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                @if(!empty($heroSlides) && count($heroSlides) > 0)

                                    @foreach($heroSlides as $heroSlide)

                                        <tr>

                                            <!-- ID -->
                                            <td>
                                                {{ $heroSlide->id }}
                                            </td>

                                            <!-- English Name -->
                                            <td class="en-column">
                                                {{ $heroSlide->name }}
                                            </td>

                                            <!-- Arabic Name -->
                                            <td class="ar-column"
                                                dir="rtl">

                                                {{ $heroSlide->name_ar ?: '—' }}

                                            </td>

                                            <!-- Slug -->
                                            <td>
                                                {{ $heroSlide->slug }}
                                            </td>

                                            <!-- Image -->
                                            <td>

                                                @if(
                                                    !empty($heroSlide->image) &&
                                                    file_exists(
                                                        public_path(
                                                            'uploads/hero_slides/thumb/large/' .
                                                            $heroSlide->image
                                                        )
                                                    )
                                                )

                                                    <img
                                                        src="{{ asset(
                                                            'uploads/hero_slides/thumb/large/' .
                                                            $heroSlide->image
                                                        ) }}"
                                                        alt="Hero Slide"
                                                        width="50"
                                                        height="50"
                                                        class="img-thumbnail"
                                                        style="object-fit: cover;">

                                                @else

                                                    <img
                                                        src="{{ asset('uploads/placeholder.jpg') }}"
                                                        alt="Placeholder"
                                                        width="50"
                                                        height="50"
                                                        class="img-thumbnail"
                                                        style="object-fit: cover;">

                                                @endif

                                            </td>

                                            <!-- Status -->
                                            <td>

                                                @if($heroSlide->status == 1)

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge bg-danger">
                                                        Block
                                                    </span>

                                                @endif

                                            </td>

                                            <!-- Action -->
                                            <td>

                                                <!-- Edit -->
                                                <a href="{{ route('heroSlide.edit', $heroSlide->id) }}"
                                                   title="Edit"
                                                   class="text-primary">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="16"
                                                         height="16"
                                                         fill="currentColor"
                                                         class="bi bi-pencil-square"
                                                         viewBox="0 0 16 16">

                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>

                                                        <path fill-rule="evenodd"
                                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>

                                                    </svg>

                                                </a>

                                                &nbsp;

                                                <!-- Delete -->
                                                <a href="javascript:void(0);"
                                                   title="Delete"
                                                   class="text-danger"
                                                   onclick="deleteHeroSlide({{ $heroSlide->id }});">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="16"
                                                         height="16"
                                                         fill="#dc3545"
                                                         class="bi bi-trash"
                                                         viewBox="0 0 16 16">

                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>

                                                        <path fill-rule="evenodd"
                                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>

                                                    </svg>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                @else

                                    <tr>

                                        <td colspan="7"
                                            class="text-center">

                                            Records Not Found

                                        </td>

                                    </tr>

                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>

        <!-- Pagination -->
        @if(!empty($heroSlides) && count($heroSlides) > 0)

            <div class="row mt-3">

                <div class="col-md-12">

                    {{ $heroSlides->appends(request()->query())->links('pagination::bootstrap-4') }}

                </div>

            </div>

        @endif

    </div>
</section>

@endsection

@section('extraJs')

<script type="text/javascript">

    /*
    |--------------------------------------------------------------------------
    | Delete Hero Slide
    |--------------------------------------------------------------------------
    */

    function deleteHeroSlide(id) {

        if (!confirm("Are you sure you want to delete?")) {
            return;
        }

        $.ajax({

            url: '{{ route("heroSlide.delete", ":id") }}'.replace(':id', id),

            type: 'POST',

            dataType: 'json',

            data: {},

            success: function(response) {

                window.location.href =
                    "{{ route('heroSlideList') }}";

            },

            error: function(xhr) {

                alert(
                    "Something went wrong. Please try again."
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Language Switcher
    |--------------------------------------------------------------------------
    */

    function setLanguage(language) {

        if (language === 'ar') {

            // Hide English
            $('.en-column').hide();

            // Show Arabic
            $('.ar-column').show();

            // RTL
            $('#heroSlideTable').attr('dir', 'rtl');

        } else {

            // Show English
            $('.en-column').show();

            // Hide Arabic
            $('.ar-column').hide();

            // LTR
            $('#heroSlideTable').attr('dir', 'ltr');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Language Selection
    |--------------------------------------------------------------------------
    */

    $(document).on('change', '#languageSelector', function() {

        const language = $(this).val();

        localStorage.setItem(
            'hero_slide_language',
            language
        );

        setLanguage(language);

    });


    /*
    |--------------------------------------------------------------------------
    | Load Saved Language
    |--------------------------------------------------------------------------
    */

    $(document).ready(function() {

        let language =
            localStorage.getItem('hero_slide_language');

        if (!language) {

            language = 'en';

            localStorage.setItem(
                'hero_slide_language',
                'en'
            );

        }

        $('#languageSelector').val(language);

        setLanguage(language);

    });

</script>

@endsection
