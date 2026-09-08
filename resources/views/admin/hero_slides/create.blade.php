@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Hero Slides / Create</h1>
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

                <form
                    action="{{ route('heroSlide.store') }}"
                    method="post"
                    name="createHeroSlideForm"
                    id="createHeroSlideForm"
                    enctype="multipart/form-data">

                    @csrf


                    <div class="card">


                        <!-- Card Header -->
                        <div class="card-header">

                            <a
                                href="{{ route('heroSlideList') }}"
                                class="btn btn-primary">

                                Back

                            </a>

                        </div>


                        <!-- Card Body -->
                        <div class="card-body">


                            <!-- ===================================================== -->
                            <!-- LANGUAGE TABS -->
                            <!-- ===================================================== -->

                            <ul
                                class="nav nav-tabs"
                                id="languageTabs"
                                role="tablist">


                                <!-- English -->
                                <li class="nav-item">

                                    <a
                                        class="nav-link active"
                                        id="english-tab"
                                        data-toggle="tab"
                                        href="#english"
                                        role="tab">

                                        English

                                    </a>

                                </li>


                                <!-- Arabic -->
                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        id="arabic-tab"
                                        data-toggle="tab"
                                        href="#arabic"
                                        role="tab">

                                        العربية

                                    </a>

                                </li>

                            </ul>


                            <!-- ===================================================== -->
                            <!-- TAB CONTENT -->
                            <!-- ===================================================== -->

                            <div class="tab-content mt-4">


                                <!-- ================================================= -->
                                <!-- ENGLISH TAB -->
                                <!-- ================================================= -->

                                <div
                                    class="tab-pane fade show active"
                                    id="english"
                                    role="tabpanel">


                                    <!-- English Name -->
                                    <div class="form-group">

                                        <label for="name">
                                            Name
                                        </label>


                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control"
                                            autocomplete="off">


                                        <div
                                            class="invalid-feedback name-error">
                                        </div>

                                    </div>


                                    <!-- Slug -->
                                    <div class="form-group">

                                        <label for="slug">
                                            Slug
                                        </label>


                                        <input
                                            type="text"
                                            name="slug"
                                            id="slug"
                                            class="form-control"
                                            readonly>


                                        <div
                                            class="invalid-feedback slug-error">
                                        </div>

                                    </div>


                                </div>


                                <!-- ================================================= -->
                                <!-- ARABIC TAB -->
                                <!-- ================================================= -->

                                <div
                                    class="tab-pane fade"
                                    id="arabic"
                                    role="tabpanel"
                                    dir="rtl"
                                    lang="ar">


                                    <!-- Arabic Name -->
                                    <div class="form-group text-right">

                                        <label for="name_ar">

                                            الاسم بالعربية

                                        </label>


                                        <input
                                            type="text"
                                            name="name_ar"
                                            id="name_ar"
                                            class="form-control text-right"
                                            dir="rtl"
                                            lang="ar"
                                            placeholder="أدخل اسم الشريحة"
                                            autocomplete="off">


                                        <div
                                            class="invalid-feedback name_ar-error text-right">
                                        </div>

                                    </div>


                                </div>


                            </div>


                            <!-- ===================================================== -->
                            <!-- IMAGE -->
                            <!-- ===================================================== -->

                            <div class="form-group mt-4">

                                <div class="row">

                                    <div class="col-md-6">


                                        <input
                                            type="hidden"
                                            name="image_id"
                                            id="image_id"
                                            value="">


                                        <label for="image">

                                            Image

                                        </label>


                                        <div
                                            id="image"
                                            class="dropzone dz-clickable">


                                            <div class="dz-message needsclick">

                                                <br>

                                                Drop files here or click to upload.

                                                <br><br>

                                            </div>


                                        </div>


                                    </div>

                                </div>

                            </div>


                            <!-- ===================================================== -->
                            <!-- STATUS -->
                            <!-- ===================================================== -->

                            <div class="form-group mt-4">

                                <label for="status">

                                    Status

                                </label>


                                <select
                                    name="status"
                                    id="status"
                                    class="form-control">


                                    <option value="1">

                                        Active

                                    </option>


                                    <option value="0">

                                        Block

                                    </option>


                                </select>

                            </div>


                            <!-- ===================================================== -->
                            <!-- SUBMIT -->
                            <!-- ===================================================== -->

                            <button
                                type="submit"
                                name="submit"
                                id="submitButton"
                                class="btn btn-primary">

                                Submit

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


/*
|--------------------------------------------------------------------------
| Dropzone
|--------------------------------------------------------------------------
*/

Dropzone.autoDiscover = false;


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
| Current Submitted Language
|--------------------------------------------------------------------------
|
| This is important for validation.
|
| If user submits from Arabic,
| Arabic remains open.
|
| If user submits from English,
| English remains open.
|
*/

let submittedLanguage = 'en';


/*
|--------------------------------------------------------------------------
| Clear Validation Errors
|--------------------------------------------------------------------------
*/

function clearValidationErrors() {

    $('.form-control').removeClass('is-invalid');

    $('.invalid-feedback').html('');

}


/*
|--------------------------------------------------------------------------
| Show Validation Errors
|--------------------------------------------------------------------------
*/

function showValidationErrors(errors) {


    /*
    |--------------------------------------------------------------------------
    | English Name
    |--------------------------------------------------------------------------
    */

    if (errors.name) {

        $('#name').addClass('is-invalid');

        $('.name-error').html(
            errors.name[0]
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Arabic Name
    |--------------------------------------------------------------------------
    */

    if (errors.name_ar) {

        $('#name_ar').addClass('is-invalid');

        $('.name_ar-error').html(
            errors.name_ar[0]
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Slug
    |--------------------------------------------------------------------------
    */

    if (errors.slug) {

        $('#slug').addClass('is-invalid');

        $('.slug-error').html(
            errors.slug[0]
        );

    }

}


/*
|--------------------------------------------------------------------------
| Create Hero Slide
|--------------------------------------------------------------------------
*/

$("#createHeroSlideForm").submit(function(event) {

    event.preventDefault();


    /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    |--------------------------------------------------------------------------
    | Capture the tab that the user is currently submitting from.
    |--------------------------------------------------------------------------
    */

    let activeTab =
        $('#languageTabs .nav-link.active').attr('href');


    if (activeTab === '#arabic') {

        submittedLanguage = 'ar';

    } else {

        submittedLanguage = 'en';

    }


    /*
    |--------------------------------------------------------------------------
    | Clear Previous Errors
    |--------------------------------------------------------------------------
    */

    clearValidationErrors();


    /*
    |--------------------------------------------------------------------------
    | Disable Submit Button
    |--------------------------------------------------------------------------
    */

    $("#submitButton").prop(
        'disabled',
        true
    );


    /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

    $.ajax({

        url: '{{ route("heroSlide.store") }}',

        type: 'POST',

        dataType: 'json',

        data:
            $("#createHeroSlideForm").serialize(),


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        success: function(response) {


            /*
            |--------------------------------------------------------------------------
            | Enable Submit Button
            |--------------------------------------------------------------------------
            */

            $("#submitButton").prop(
                'disabled',
                false
            );


            /*
            |--------------------------------------------------------------------------
            | Successfully Created
            |--------------------------------------------------------------------------
            */

            if (response.status == 200) {

                window.location.href =
                    '{{ route("heroSlideList") }}';

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Validation Errors
            |--------------------------------------------------------------------------
            */

            if (response.errors) {


                showValidationErrors(
                    response.errors
                );


                /*
                |--------------------------------------------------------------------------
                | Keep User On Submitted Language
                |--------------------------------------------------------------------------
                */

                if (
                    submittedLanguage === 'ar' &&
                    response.errors.name_ar
                ) {

                    $('#arabic-tab').tab('show');

                }


                else if (
                    submittedLanguage === 'en' &&
                    response.errors.name
                ) {

                    $('#english-tab').tab('show');

                }


                /*
                |--------------------------------------------------------------------------
                | If Submitted Language Has No Error,
                | Open The Tab Which Has The Error
                |--------------------------------------------------------------------------
                */

                else if (response.errors.name_ar) {

                    $('#arabic-tab').tab('show');

                }


                else if (response.errors.name) {

                    $('#english-tab').tab('show');

                }


                else if (response.errors.slug) {

                    $('#english-tab').tab('show');

                }

            }

        },


        /*
        |--------------------------------------------------------------------------
        | AJAX Error
        |--------------------------------------------------------------------------
        */

        error: function(xhr) {


            $("#submitButton").prop(
                'disabled',
                false
            );


            /*
            |--------------------------------------------------------------------------
            | Laravel Validation Response
            |--------------------------------------------------------------------------
            */

            if (
                xhr.responseJSON &&
                xhr.responseJSON.errors
            ) {


                showValidationErrors(
                    xhr.responseJSON.errors
                );


                /*
                |--------------------------------------------------------------------------
                | Keep Correct Tab Open
                |--------------------------------------------------------------------------
                */

                if (
                    submittedLanguage === 'ar' &&
                    xhr.responseJSON.errors.name_ar
                ) {

                    $('#arabic-tab').tab('show');

                }


                else if (
                    submittedLanguage === 'en' &&
                    xhr.responseJSON.errors.name
                ) {

                    $('#english-tab').tab('show');

                }


                else if (
                    xhr.responseJSON.errors.name_ar
                ) {

                    $('#arabic-tab').tab('show');

                }


                else {

                    $('#english-tab').tab('show');

                }

            }

        }

    });

});


/*
|--------------------------------------------------------------------------
| Generate Slug
|--------------------------------------------------------------------------
|
| Slug is generated ONLY from English name.
|
*/

$("#name").on('change keyup', function() {


    let name =
        $(this).val().trim();


    /*
    |--------------------------------------------------------------------------
    | Empty Name
    |--------------------------------------------------------------------------
    */

    if (name === '') {

        $("#slug").val('');

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | Disable Submit While Generating Slug
    |--------------------------------------------------------------------------
    */

    $("#submitButton").prop(
        'disabled',
        true
    );


    /*
    |--------------------------------------------------------------------------
    | AJAX Slug
    |--------------------------------------------------------------------------
    */

    $.ajax({

        url: '{{ route("heroSlide.slug") }}',

        type: 'GET',


        data: {

            name: name

        },


        dataType: 'json',


        success: function(response) {


            $("#submitButton").prop(
                'disabled',
                false
            );


            if (response.status == true) {


                $("#slug").val(
                    response.slug
                );


                /*
                |--------------------------------------------------------------------------
                | Remove Slug Error
                |--------------------------------------------------------------------------
                */

                $("#slug").removeClass(
                    'is-invalid'
                );


                $(".slug-error").html('');

            }

        },


        error: function() {


            $("#submitButton").prop(
                'disabled',
                false
            );

        }

    });

});


/*
|--------------------------------------------------------------------------
| Remove English Validation Error While Typing
|--------------------------------------------------------------------------
*/

$('#name').on('input', function() {

    $(this).removeClass(
        'is-invalid'
    );

    $('.name-error').html('');

});


/*
|--------------------------------------------------------------------------
| Remove Arabic Validation Error While Typing
|--------------------------------------------------------------------------
*/

$('#name_ar').on('input', function() {

    $(this).removeClass(
        'is-invalid'
    );

    $('.name_ar-error').html('');

});


/*
|--------------------------------------------------------------------------
| Remove Slug Validation Error
|--------------------------------------------------------------------------
*/

$('#slug').on('input', function() {

    $(this).removeClass(
        'is-invalid'
    );

    $('.slug-error').html('');

});


/*
|--------------------------------------------------------------------------
| Language Memory
|--------------------------------------------------------------------------
*/

$(document).ready(function() {


    /*
    |--------------------------------------------------------------------------
    | Get Previously Selected Language
    |--------------------------------------------------------------------------
    */

    let language =
        localStorage.getItem(
            'hero_slide_language'
        );


    /*
    |--------------------------------------------------------------------------
    | Default English
    |--------------------------------------------------------------------------
    */

    if (!language) {

        language = 'en';

        localStorage.setItem(
            'hero_slide_language',
            'en'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Open Previously Selected Tab
    |--------------------------------------------------------------------------
    */

    if (language === 'ar') {

        $('#arabic-tab').tab('show');

    } else {

        $('#english-tab').tab('show');

    }


    /*
    |--------------------------------------------------------------------------
    | Save Selected Language
    |--------------------------------------------------------------------------
    */

    $('a[data-toggle="tab"]').on(
        'shown.bs.tab',
        function(e) {


            let target =
                $(e.target).attr('href');


            /*
            |--------------------------------------------------------------------------
            | Arabic
            |--------------------------------------------------------------------------
            */

            if (target === '#arabic') {

                localStorage.setItem(
                    'hero_slide_language',
                    'ar'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | English
            |--------------------------------------------------------------------------
            */

            else {

                localStorage.setItem(
                    'hero_slide_language',
                    'en'
                );

            }

        }
    );


});

</script>

@endsection

