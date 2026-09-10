@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">REVIEWS / List</h1>
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

                <!-- Success Message -->
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif


                <!-- Error Message -->
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

                                <a href="{{ route('review.create') }}"
                                   class="btn btn-primary">
                                    Create
                                </a>

                            </div>


                            <!-- Language + Search -->
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

                                    <form action="{{ route('reviewList') }}"
                                          method="get">

                                        <div class="input-group mb-0"
                                             style="width: 300px;">

                                            <input
                                                type="text"
                                                name="keyword"
                                                value="{{ request('keyword', '') }}"
                                                class="form-control"
                                                placeholder="Search">

                                            <div class="input-group-append">

                                                <button type="submit"
                                                        class="btn btn-default">

                                                    <i class="fas fa-search"></i>

                                                </button>

                                            </div>

                                            <a href="{{ route('reviewList') }}"
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
                               id="reviewTable">

                            <thead>

                                <tr>

                                    <!-- ID -->
                                    <th width="50">
                                        ID
                                    </th>


                                    <!-- English Name -->
                                    <th class="en-column">
                                        English Name
                                    </th>


                                    <!-- Arabic Name -->
                                    <th class="ar-column"
                                        dir="rtl">

                                        اسم العميل

                                    </th>


                                    <!-- Slug -->
                                    <th width="180">
                                        Slug
                                    </th>


                                    <!-- English Review -->
                                    <th class="en-column"
                                        width="250">

                                        Review

                                    </th>


                                    <!-- Arabic Review -->
                                    <th class="ar-column"
                                        dir="rtl"
                                        width="250">

                                        التقييم

                                    </th>


                                    <!-- Rating -->
                                    <th width="120">
                                        Rating
                                    </th>


                                    <!-- Review Date -->
                                    <th width="130">
                                        Review Date
                                    </th>


                                    <!-- Image -->
                                    <th width="100">
                                        Image
                                    </th>


                                    <!-- Status -->
                                    <th width="100">
                                        Status
                                    </th>


                                    <!-- Action -->
                                    <th width="100">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @if(!empty($reviews) && count($reviews) > 0)

                                    @foreach($reviews as $review)

                                        <tr>

                                            <!-- ID -->
                                            <td>
                                                {{ $review->id }}
                                            </td>


                                            <!-- English Name -->
                                            <td class="en-column">

                                                {{ $review->name }}

                                            </td>


                                            <!-- Arabic Name -->
                                            <td class="ar-column"
                                                dir="rtl">

                                                {{ $review->name_ar ?: '—' }}

                                            </td>


                                            <!-- Slug -->
                                            <td>

                                                {{ $review->slug }}

                                            </td>


                                            <!-- English Review -->
                                            <td class="en-column">

                                                {{ \Illuminate\Support\Str::limit(
                                                    $review->review,
                                                    80
                                                ) }}

                                            </td>


                                            <!-- Arabic Review -->
                                            <td class="ar-column"
                                                dir="rtl">

                                                {{ \Illuminate\Support\Str::limit(
                                                    $review->review_ar ?? '',
                                                    80
                                                ) ?: '—' }}

                                            </td>


                                            <!-- Rating -->
                                            <td>

                                                <span class="text-warning">

                                                    @for($i = 1; $i <= 5; $i++)

                                                        @if($i <= $review->rating)

                                                            <i class="fas fa-star"></i>

                                                        @else

                                                            <i class="far fa-star"></i>

                                                        @endif

                                                    @endfor

                                                </span>

                                                <small class="text-muted">
                                                    ({{ $review->rating }}/5)
                                                </small>

                                            </td>


                                            <!-- Review Date -->
                                            <td>

                                                @if(!empty($review->review_date))

                                                    {{ \Carbon\Carbon::parse(
                                                        $review->review_date
                                                    )->format('d M Y') }}

                                                @else

                                                    —

                                                @endif

                                            </td>


                                            <!-- Image -->
                                            <td>

                                                @if(
                                                    !empty($review->image) &&
                                                    file_exists(
                                                        public_path(
                                                            'uploads/reviews/thumb/small/' .
                                                            $review->image
                                                        )
                                                    )
                                                )

                                                    <img
                                                        src="{{ asset(
                                                            'uploads/reviews/thumb/small/' .
                                                            $review->image
                                                        ) }}"
                                                        alt="Review Image"
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

                                                @if($review->status == 1)

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
                                                <a href="{{ route(
                                                    'review.edit',
                                                    $review->id
                                                ) }}"
                                                   title="Edit"
                                                   class="text-primary">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">

                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293a.5.5 0 0 1 0 .706z"/>

                                                        <path d="M13.854 4.146l-2-2L4.939 9.061a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>

                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>

                                                    </svg>

                                                </a>


                                                &nbsp;


                                                <!-- Delete -->
                                                <a href="javascript:void(0);"
                                                   title="Delete"
                                                   class="text-danger"
                                                   onclick="deleteReview({{ $review->id }});">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-trash"
                                                        viewBox="0 0 16 16">

                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>

                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M14.5 3a.5.5 0 0 1-1 0V2h-3.5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1H2.5A1.5 1.5 0 0 0 1 3.5v.5h1v9A2 2 0 0 0 4 15h8a2 2 0 0 0 2-2V4h1V3h-.5zM4 4h8v9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4z"/>

                                                    </svg>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach


                                @else

                                    <tr>

                                        <td colspan="11"
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
        @if(!empty($reviews))

            <div class="row mt-3">

                <div class="col-md-12">

                    {{ $reviews->appends(
                        request()->query()
                    )->links('pagination::bootstrap-4') }}

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
| DELETE REVIEW
|--------------------------------------------------------------------------
*/

function deleteReview(id) {

    if (!confirm("Are you sure you want to delete?")) {
        return;
    }

    $.ajax({

        url: '{{ url("admin/review/delete") }}/' + id,

        type: 'POST',

        dataType: 'json',

        data: {},

        success: function(response) {

            window.location.href =
                "{{ route('reviewList') }}";

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
| SET LANGUAGE
|--------------------------------------------------------------------------
*/

function setLanguage(language) {

    if (language === 'ar') {

        // Hide English columns
        $('.en-column').hide();

        // Show Arabic columns
        $('.ar-column').show();

        // RTL table
        $('#reviewTable').attr('dir', 'rtl');

    } else {

        // Show English columns
        $('.en-column').show();

        // Hide Arabic columns
        $('.ar-column').hide();

        // LTR table
        $('#reviewTable').attr('dir', 'ltr');

    }

}


/*
|--------------------------------------------------------------------------
| LANGUAGE SELECTOR
|--------------------------------------------------------------------------
*/

$(document).on(
    'change',
    '#languageSelector',
    function() {

        const language = $(this).val();

        // Save selected language
        localStorage.setItem(
            'review_language',
            language
        );

        // Apply selected language
        setLanguage(language);

    }
);


/*
|--------------------------------------------------------------------------
| INITIALIZE LANGUAGE
|--------------------------------------------------------------------------
*/

$(document).ready(function() {

    let language =
        localStorage.getItem('review_language');


    // Default language
    if (!language) {

        language = 'en';

        localStorage.setItem(
            'review_language',
            'en'
        );

    }


    // Set selected option
    $('#languageSelector').val(language);


    // Apply language
    setLanguage(language);

});

</script>

@endsection

