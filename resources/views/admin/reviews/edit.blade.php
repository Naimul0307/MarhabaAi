@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">
                    Reviews / Edit
                </h1>
            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit
                    </li>

                </ol>

            </div>

        </div>

    </div>
</div>


<section class="content h-100">

    <div class="container-fluid h-100">

        <div class="row">

            <div class="col-md-12">

                <form action="{{ route('review.update', $review->id) }}"
                      method="post"
                      name="editReviewForm"
                      id="editReviewForm">

                    @csrf

                    <div class="card">

                        <div class="card-header">

                            <a href="{{ route('reviewList') }}"
                               class="btn btn-primary">
                                Back
                            </a>

                        </div>


                        <div class="card-body">

                            {{-- LANGUAGE TABS --}}
                            <ul class="nav nav-tabs mb-4"
                                id="reviewLanguageTab">

                                <li class="nav-item">

                                    <a class="nav-link active"
                                       id="english-tab"
                                       data-toggle="tab"
                                       href="#english">
                                        English
                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link"
                                       id="arabic-tab"
                                       data-toggle="tab"
                                       href="#arabic">
                                        العربية
                                    </a>

                                </li>

                            </ul>


                            <div class="tab-content">

                                {{-- ENGLISH --}}
                                <div class="tab-pane fade show active"
                                     id="english">

                                    <div class="form-group">

                                        <label for="name">
                                            Name
                                        </label>

                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ $review->name }}"
                                               class="form-control">

                                        <p class="error name-error"></p>

                                    </div>


                                    <div class="form-group">

                                        <label for="slug">
                                            Slug
                                        </label>

                                        <input type="text"
                                               readonly
                                               name="slug"
                                               id="slug"
                                               value="{{ $review->slug }}"
                                               class="form-control">

                                        <p class="error slug-error"></p>

                                    </div>


                                    <div class="form-group">

                                        <label for="review">
                                            Review
                                        </label>

                                        <textarea name="review"
                                                  id="review"
                                                  class="form-control"
                                                  rows="5">{{ $review->review }}</textarea>

                                        <p class="error review-error"></p>

                                    </div>

                                </div>


                                {{-- ARABIC --}}
                                <div class="tab-pane fade"
                                     id="arabic"
                                     dir="rtl">

                                    <div class="form-group">

                                        <label for="name_ar">
                                            الاسم بالعربية
                                        </label>

                                        <input type="text"
                                               name="name_ar"
                                               id="name_ar"
                                               value="{{ $review->name_ar }}"
                                               class="form-control">

                                        <p class="error name_ar-error"></p>

                                    </div>


                                    <div class="form-group">

                                        <label for="review_ar">
                                            المراجعة بالعربية
                                        </label>

                                        <textarea name="review_ar"
                                                  id="review_ar"
                                                  class="form-control"
                                                  rows="5">{{ $review->review_ar }}</textarea>

                                        <p class="error review_ar-error"></p>

                                    </div>

                                </div>

                            </div>


                            {{-- RATING --}}
                            <div class="form-group mt-4">

                                <label for="rating">
                                    Rating
                                </label>

                                <select name="rating"
                                        id="rating"
                                        class="form-control">

                                    <option value="5"
                                        {{ $review->rating == 5 ? 'selected' : '' }}>
                                        5 Stars
                                    </option>

                                    <option value="4"
                                        {{ $review->rating == 4 ? 'selected' : '' }}>
                                        4 Stars
                                    </option>

                                    <option value="3"
                                        {{ $review->rating == 3 ? 'selected' : '' }}>
                                        3 Stars
                                    </option>

                                    <option value="2"
                                        {{ $review->rating == 2 ? 'selected' : '' }}>
                                        2 Stars
                                    </option>

                                    <option value="1"
                                        {{ $review->rating == 1 ? 'selected' : '' }}>
                                        1 Star
                                    </option>

                                </select>

                                <p class="error rating-error"></p>

                            </div>


                            {{-- REVIEW DATE --}}
                            <div class="form-group">

                                <label for="review_date">
                                    Review Date
                                </label>

                                <input type="date"
                                       name="review_date"
                                       id="review_date"
                                       value="{{ $review->review_date ? \Carbon\Carbon::parse($review->review_date)->format('Y-m-d') : '' }}"
                                       class="form-control">

                                <p class="error review_date-error"></p>

                            </div>


                            {{-- IMAGE --}}
                            <div class="form-group">

                                <div class="row">

                                    <div class="col-md-6">

                                        <input type="hidden"
                                               name="image_id"
                                               id="image_id"
                                               value="">

                                        <label for="image">
                                            Image
                                        </label>

                                        <div id="image"
                                             class="dropzone dz-clickable">

                                            <div class="dz-message needsclick">

                                                <br>
                                                Drop files here or click to upload.
                                                <br><br>

                                            </div>

                                        </div>


                                        @if(!empty($review->image))

                                            <div class="current-image mt-3">

                                                <img class="img-thumbnail"
                                                     src="{{ asset('uploads/reviews/thumb/large/'.$review->image) }}"
                                                     width="300">

                                                <br>

                                                <button type="button"
                                                        class="btn btn-danger btn-sm remove-image mt-2"
                                                        data-image="{{ $review->image }}">
                                                    Remove
                                                </button>

                                            </div>

                                        @endif

                                        <p class="error image_id-error"></p>

                                    </div>

                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="form-group mt-4">

                                <label for="status">
                                    Status
                                </label>

                                <select name="status"
                                        id="status"
                                        class="form-control">

                                    <option value="1"
                                        {{ $review->status == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ $review->status == 0 ? 'selected' : '' }}>
                                        Block
                                    </option>

                                </select>

                                <p class="error status-error"></p>

                            </div>


                            <button type="submit"
                                    name="submit"
                                    class="btn btn-primary">
                                Update
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection


@section('extraJs')

<script type="text/javascript">

Dropzone.autoDiscover = false;


/*
|--------------------------------------------------------------------------
| DROPZONE
|--------------------------------------------------------------------------
*/

const dropzone = $("#image").dropzone({

    init: function() {

        this.on('addedfile', function(file) {

            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }

        });

    },

    url: "{{ route('tempUpload') }}",

    maxFiles: 1,

    addRemoveLinks: true,

    acceptedFiles:
        "image/jpeg,image/png,image/gif,image/webp,image/avif",

    headers: {
        'X-CSRF-TOKEN':
            $('meta[name="_token"]').attr('content')
    },

    success: function(file, response) {

        $("#image_id").val(response.id);

    }

});


/*
|--------------------------------------------------------------------------
| CLEAR ERRORS
|--------------------------------------------------------------------------
*/

function clearErrors() {

    $('.error').html('');

}


/*
|--------------------------------------------------------------------------
| SHOW ERRORS
|--------------------------------------------------------------------------
*/


function showErrors(errors) {

    clearErrors();

    /*
    |--------------------------------------------------------------------------
    | English Errors
    |--------------------------------------------------------------------------
    */

    if (errors.name) {
        $('.name-error').html(errors.name[0]);
    }

    if (errors.slug) {
        $('.slug-error').html(errors.slug[0]);
    }

    if (errors.review) {
        $('.review-error').html(errors.review[0]);
    }


    /*
    |--------------------------------------------------------------------------
    | Arabic Errors
    |--------------------------------------------------------------------------
    */

    if (errors.name_ar) {
        $('.name_ar-error').html(errors.name_ar[0]);
    }

    if (errors.review_ar) {
        $('.review_ar-error').html(errors.review_ar[0]);
    }


    /*
    |--------------------------------------------------------------------------
    | Other Errors
    |--------------------------------------------------------------------------
    */

    if (errors.rating) {
        $('.rating-error').html(errors.rating[0]);
    }

    if (errors.review_date) {
        $('.review_date-error').html(errors.review_date[0]);
    }

    if (errors.image_id) {
        $('.image_id-error').html(errors.image_id[0]);
    }

    if (errors.status) {
        $('.status-error').html(errors.status[0]);
    }


    /*
    |--------------------------------------------------------------------------
    | Decide Which Tab To Show
    |--------------------------------------------------------------------------
    |
    | Arabic errors -> Arabic tab
    | English errors -> English tab
    |
    */

    if (errors.name_ar || errors.review_ar) {

        $('#arabic-tab').tab('show');

        localStorage.setItem(
            'review_language',
            'ar'
        );

    } else if (
        errors.name ||
        errors.slug ||
        errors.review
    ) {

        $('#english-tab').tab('show');

        localStorage.setItem(
            'review_language',
            'en'
        );

    }

}



/*
|--------------------------------------------------------------------------
| LANGUAGE MEMORY
|--------------------------------------------------------------------------
*/

$('#reviewLanguageTab a').on(
    'shown.bs.tab',
    function(e) {

        let language =
            $(e.target).attr('href') === '#arabic'
                ? 'ar'
                : 'en';

        localStorage.setItem(
            'review_language',
            language
        );

    }
);


let reviewLanguage =
    localStorage.getItem('review_language') || 'en';

if (reviewLanguage === 'ar') {

    $('#arabic-tab').tab('show');

} else {

    $('#english-tab').tab('show');

}


/*
|--------------------------------------------------------------------------
| UPDATE FORM
|--------------------------------------------------------------------------
*/

$("#editReviewForm").submit(function(event) {

    event.preventDefault();

    $("button[type='submit']")
        .prop('disabled', true);

    clearErrors();

    $.ajax({

        url: '{{ route("review.update", $review->id) }}',

        type: 'POST',

        dataType: 'json',

        data: $("#editReviewForm").serialize(),

        success: function(response) {

            $("button[type='submit']")
                .prop('disabled', false);

            if (response.status == 200) {

                window.location.href =
                    '{{ route("reviewList") }}';

            } else {

                showErrors(
                    response.errors || {}
                );

            }

        },

        error: function(xhr) {

            $("button[type='submit']")
                .prop('disabled', false);

            if (
                xhr.status === 422 &&
                xhr.responseJSON
            ) {

                showErrors(
                    xhr.responseJSON.errors || {}
                );

            } else {

                console.log(
                    xhr.responseText
                );

                alert(
                    'Server error. Please check Laravel logs.'
                );

            }

        }

    });

});


/*
|--------------------------------------------------------------------------
| REMOVE IMAGE
|--------------------------------------------------------------------------
*/

$(document).on(
    'click',
    '.remove-image',
    function() {

        let button = $(this);

        let imageName =
            button.data('image');

        $.ajax({

            url: "{{ route('review.remove.image', $review->id) }}",

            type: 'POST',

            data: {

                image: imageName,

                _token:
                    $('meta[name="_token"]').attr('content')

            },

            success: function(response) {

                if (response.status === 200) {

                    button
                        .closest('.current-image')
                        .remove();

                    $("#image_id").val('');

                } else {

                    alert(
                        response.message
                    );

                }

            },

            error: function(xhr) {

                console.log(
                    xhr.responseText
                );

                alert(
                    'Error removing image.'
                );

            }

        });

    }
);


/*
|--------------------------------------------------------------------------
| GENERATE SLUG
|--------------------------------------------------------------------------
*/

let slugTimer;

$("#name").on('input', function() {

    clearTimeout(slugTimer);

    let name = $(this).val();

    if (!name) {

        $("#slug").val('');

        return;

    }

    $("button[type='submit']")
        .prop('disabled', true);

    slugTimer = setTimeout(function() {

        $.ajax({

            url: '{{ route("review.slug") }}',

            type: 'GET',

            data: {

                name: name,

                id: "{{ $review->id }}"

            },

            dataType: 'json',

            success: function(response) {

                $("#slug").val(
                    response.slug
                );

                $("button[type='submit']")
                    .prop('disabled', false);

            },

            error: function() {

                $("button[type='submit']")
                    .prop('disabled', false);

            }

        });

    }, 300);

});

</script>

@endsection

