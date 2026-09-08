@extends('admin.layouts.app')

@section('content')

    <!-- Content Header -->
    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">
                        Category / Create
                    </h1>

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
                        action="{{ route('category.save') }}"
                        method="POST"
                        name="createCategoryForm"
                        id="createCategoryForm"
                    >

                        @csrf

                        <div class="card">


                            <!-- Card Header -->
                            <div class="card-header">

                                <a
                                    href="{{ route('categoryList') }}"
                                    class="btn btn-primary"
                                >
                                    Back
                                </a>

                            </div>


                            <!-- Card Body -->
                            <div class="card-body">


                                <!-- Language Tabs -->

                                <ul
                                    class="nav nav-tabs"
                                    id="languageTabs"
                                    role="tablist"
                                >

                                    <li class="nav-item">

                                        <a
                                            class="nav-link active"
                                            id="english-tab"
                                            data-toggle="tab"
                                            href="#english"
                                            role="tab"
                                        >
                                            English
                                        </a>

                                    </li>


                                    <li class="nav-item">

                                        <a
                                            class="nav-link"
                                            id="arabic-tab"
                                            data-toggle="tab"
                                            href="#arabic"
                                            role="tab"
                                        >
                                            العربية
                                        </a>

                                    </li>

                                </ul>


                                <!-- Tab Content -->

                                <div class="tab-content mt-4">


                                    <!-- ================================================= -->
                                    <!-- ENGLISH -->
                                    <!-- ================================================= -->

                                    <div
                                        class="tab-pane fade show active"
                                        id="english"
                                        role="tabpanel"
                                    >


                                        <!-- Name -->

                                        <div class="form-group">

                                            <label for="name">
                                                Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="form-control"
                                                value="{{ old('name') }}"
                                            >

                                            <p class="error name-error"></p>

                                        </div>


                                    <!-- SLUG -->

                                    <div class="form-group mt-4">

                                        <label for="slug">
                                            Slug
                                        </label>

                                        <input
                                            type="text"
                                            readonly
                                            name="slug"
                                            id="slug"
                                            class="form-control"
                                            value="{{ old('slug') }}"
                                        >

                                        <p class="error slug-error"></p>

                                    </div>

                                        <!-- Description -->

                                        <div class="form-group">

                                            <label>
                                                Description
                                            </label>

                                            <textarea
                                                name="description"
                                                rows="7"
                                                class="form-control"
                                                placeholder="MAX 160 CHARACTERS"
                                            >{{ old('description') }}</textarea>

                                            <p class="error description-error"></p>

                                        </div>


                                        <!-- Meta Title -->

                                        <div class="form-group">

                                            <label>
                                                Meta Title
                                            </label>

                                            <input
                                                type="text"
                                                name="meta_title"
                                                class="form-control"
                                                placeholder="MAX 70 CHARACTERS"
                                                value="{{ old('meta_title') }}"
                                            >

                                            <p class="error meta_title-error"></p>

                                        </div>


                                        <!-- Meta Description -->

                                        <div class="form-group">

                                            <label>
                                                Meta Description
                                            </label>

                                            <textarea
                                                name="meta_description"
                                                rows="7"
                                                class="form-control"
                                                placeholder="MAX 160 CHARACTERS"
                                            >{{ old('meta_description') }}</textarea>

                                            <p class="error meta_description-error"></p>

                                        </div>


                                        <!-- Meta Keywords -->

                                        <div class="form-group">

                                            <label>
                                                Meta Keywords
                                            </label>

                                            <textarea
                                                name="meta_keywords"
                                                rows="5"
                                                class="form-control"
                                            >{{ old('meta_keywords') }}</textarea>

                                            <p class="error meta_keywords-error"></p>

                                        </div>


                                    </div>


                                    <!-- ================================================= -->
                                    <!-- ARABIC -->
                                    <!-- ================================================= -->

                                    <div
                                        class="tab-pane fade"
                                        id="arabic"
                                        role="tabpanel"
                                    >


                                        <!-- Arabic Name -->

                                        <div class="form-group">

                                            <label for="name_ar">
                                                الاسم بالعربية
                                            </label>

                                            <input
                                                type="text"
                                                name="name_ar"
                                                id="name_ar"
                                                class="form-control"
                                                dir="rtl"
                                                placeholder="أدخل اسم الفئة"
                                                value="{{ old('name_ar') }}"
                                            >

                                            <p class="error name_ar-error"></p>

                                        </div>


                                        <!-- Arabic Description -->

                                        <div class="form-group">

                                            <label>
                                                الوصف
                                            </label>

                                            <textarea
                                                name="description_ar"
                                                rows="7"
                                                class="form-control"
                                                dir="rtl"
                                                placeholder="أدخل وصف الفئة"
                                            >{{ old('description_ar') }}</textarea>

                                            <p class="error description_ar-error"></p>

                                        </div>


                                        <!-- Arabic Meta Title -->

                                        <div class="form-group">

                                            <label>
                                                عنوان Meta
                                            </label>

                                            <input
                                                type="text"
                                                name="meta_title_ar"
                                                class="form-control"
                                                dir="rtl"
                                                value="{{ old('meta_title_ar') }}"
                                            >

                                            <p class="error meta_title_ar-error"></p>

                                        </div>


                                        <!-- Arabic Meta Description -->

                                        <div class="form-group">

                                            <label>
                                                وصف Meta
                                            </label>

                                            <textarea
                                                name="meta_description_ar"
                                                rows="7"
                                                class="form-control"
                                                dir="rtl"
                                            >{{ old('meta_description_ar') }}</textarea>

                                            <p class="error meta_description_ar-error"></p>

                                        </div>


                                        <!-- Arabic Meta Keywords -->

                                        <div class="form-group">

                                            <label>
                                                الكلمات المفتاحية
                                            </label>

                                            <textarea
                                                name="meta_keywords_ar"
                                                rows="5"
                                                class="form-control"
                                                dir="rtl"
                                            >{{ old('meta_keywords_ar') }}</textarea>

                                            <p class="error meta_keywords_ar-error"></p>

                                        </div>


                                    </div>

                                </div>



                                <!-- IMAGE -->

                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input
                                                type="hidden"
                                                name="image_id"
                                                id="image_id"
                                                value=""
                                            >

                                            <label>
                                                Image
                                            </label>

                                            <div
                                                id="image"
                                                class="dropzone dz-clickable"
                                            >

                                                <div class="dz-message needsclick">

                                                    <br>

                                                    Drop files here or click to upload.

                                                    <br><br>

                                                </div>

                                            </div>

                                            <p class="error image_id-error"></p>

                                        </div>

                                    </div>

                                </div>


                                <!-- STATUS -->

                                <div class="form-group mt-4">

                                    <label for="status">
                                        Status
                                    </label>

                                    <select
                                        name="status"
                                        id="status"
                                        class="form-control"
                                    >

                                        <option value="1">
                                            Active
                                        </option>

                                        <option value="0">
                                            Block
                                        </option>

                                    </select>

                                    <p class="error status-error"></p>

                                </div>


                                <!-- SUBMIT -->

                                <button
                                    type="submit"
                                    name="submit"
                                    id="submitBtn"
                                    class="btn btn-primary"
                                >
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
| DROPZONE
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


    /*
    |--------------------------------------------------------------------------
    | Upload Success
    |--------------------------------------------------------------------------
    */

    success: function(file, response) {

        $("#image_id").val(response.id);

        $(".image_id-error")
            .html("")
            .hide();

        /*
        |--------------------------------------------------------------------------
        | Remove Invalid Class
        |--------------------------------------------------------------------------
        */

        $("#image_id")
            .removeClass("is-invalid");

        $("#image")
            .removeClass("is-invalid");

    },


    /*
    |--------------------------------------------------------------------------
    | Upload Error
    |--------------------------------------------------------------------------
    */

    error: function(file, response) {

        console.log(response);

    }

});



/*
|--------------------------------------------------------------------------
| CLEAR ALL ERRORS
|--------------------------------------------------------------------------
*/

function clearErrors()
{
    /*
    |--------------------------------------------------------------------------
    | Clear Error Messages
    |--------------------------------------------------------------------------
    */

    $(".error")
        .html("")
        .hide();


    /*
    |--------------------------------------------------------------------------
    | Remove Invalid Class From All Form Controls
    |--------------------------------------------------------------------------
    */

    $(".form-control")
        .removeClass("is-invalid");


    /*
    |--------------------------------------------------------------------------
    | Remove Invalid From Image
    |--------------------------------------------------------------------------
    */

    $("#image")
        .removeClass("is-invalid");
}



/*
|--------------------------------------------------------------------------
| SHOW VALIDATION ERRORS
|--------------------------------------------------------------------------
*/

function showErrors(errors)
{
    clearErrors();

    if (errors.name && errors.name.length > 0) {

        $("#name").addClass("is-invalid");

        $(".name-error")
            .html(errors.name[0])
            .show();
    }

    if (errors.slug && errors.slug.length > 0) {

        $("#slug").addClass("is-invalid");

        $(".slug-error")
            .html(errors.slug[0])
            .show();
    }

    // Always open English tab because
    // only name and slug errors are displayed.
    $("#english-tab").tab("show");

    localStorage.setItem(
        "category_language",
        "en"
    );
}


/*
|--------------------------------------------------------------------------
| SUBMIT CATEGORY FORM
|--------------------------------------------------------------------------
*/

$("#createCategoryForm").submit(function(event)
{
    event.preventDefault();


    /*
    |--------------------------------------------------------------------------
    | Submit Button
    |--------------------------------------------------------------------------
    */

    let submitButton =
        $("#submitBtn");


    /*
    |--------------------------------------------------------------------------
    | Disable Submit Button
    |--------------------------------------------------------------------------
    */

    submitButton.prop(
        "disabled",
        true
    );


    /*
    |--------------------------------------------------------------------------
    | Clear Old Errors
    |--------------------------------------------------------------------------
    */

    clearErrors();


    /*
    |--------------------------------------------------------------------------
    | AJAX REQUEST
    |--------------------------------------------------------------------------
    */

    $.ajax({

        url:
            '{{ route("category.save") }}',

        type:
            'POST',

        dataType:
            'json',

        data:
            $("#createCategoryForm").serialize(),


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        success: function(response)
        {
            /*
            |--------------------------------------------------------------------------
            | Enable Submit Button
            |--------------------------------------------------------------------------
            */

            submitButton.prop(
                "disabled",
                false
            );


            /*
            |--------------------------------------------------------------------------
            | SUCCESS REDIRECT
            |--------------------------------------------------------------------------
            */

            if (response.status == 200)
            {
                window.location.href =
                    '{{ route("categoryList") }}';

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | VALIDATION ERRORS RETURNED WITH 200
            |--------------------------------------------------------------------------
            */

            if (response.errors)
            {
                showErrors(
                    response.errors
                );
            }
        },


        /*
        |--------------------------------------------------------------------------
        | VALIDATION / SERVER ERROR
        |--------------------------------------------------------------------------
        */

        error: function(xhr)
        {
            /*
            |--------------------------------------------------------------------------
            | Enable Submit Button
            |--------------------------------------------------------------------------
            */

            submitButton.prop(
                "disabled",
                false
            );


            /*
            |--------------------------------------------------------------------------
            | Laravel Validation Error
            |--------------------------------------------------------------------------
            */

            if (xhr.status === 422)
            {
                let errors =
                    xhr.responseJSON.errors;

                showErrors(errors);

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Other Server Error
            |--------------------------------------------------------------------------
            */

            console.log(
                xhr.responseText
            );
        }

    });

});



/*
|--------------------------------------------------------------------------
| GENERATE SLUG
|--------------------------------------------------------------------------
*/

$("#name").on(
    "keyup change",
    function()
    {
        let name =
            $(this).val();


        /*
        |--------------------------------------------------------------------------
        | User Started Correcting Name
        |--------------------------------------------------------------------------
        */

        $("#name")
            .removeClass("is-invalid");

        $(".name-error")
            .html("")
            .hide();


        /*
        |--------------------------------------------------------------------------
        | Empty Name
        |--------------------------------------------------------------------------
        */

        if (name.trim() === "")
        {
            /*
            |--------------------------------------------------------------------------
            | Clear Slug
            |--------------------------------------------------------------------------
            */

            $("#slug").val("");


            /*
            |--------------------------------------------------------------------------
            | Remove Slug Error
            |--------------------------------------------------------------------------
            */

            $("#slug")
                .removeClass("is-invalid");

            $(".slug-error")
                .html("")
                .hide();

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Disable Submit While Generating Slug
        |--------------------------------------------------------------------------
        */

        $("#submitBtn").prop(
            "disabled",
            true
        );


        /*
        |--------------------------------------------------------------------------
        | Generate Slug AJAX
        |--------------------------------------------------------------------------
        */

        $.ajax({

            url:
                '{{ route("category.slug") }}',

            type:
                'GET',

            data:
            {
                name: name
            },

            dataType:
                'json',


            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            success: function(response)
            {
                /*
                |--------------------------------------------------------------------------
                | Enable Submit
                |--------------------------------------------------------------------------
                */

                $("#submitBtn").prop(
                    "disabled",
                    false
                );


                /*
                |--------------------------------------------------------------------------
                | Slug Generated Successfully
                |--------------------------------------------------------------------------
                */

                if (response.status == 200)
                {
                    /*
                    |--------------------------------------------------------------------------
                    | Put Slug Into Input
                    |--------------------------------------------------------------------------
                    */

                    $("#slug").val(
                        response.slug
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Remove Invalid Classes
                    |--------------------------------------------------------------------------
                    */

                    $("#name")
                        .removeClass("is-invalid");

                    $("#slug")
                        .removeClass("is-invalid");


                    /*
                    |--------------------------------------------------------------------------
                    | Clear Errors
                    |--------------------------------------------------------------------------
                    */

                    $(".name-error")
                        .html("")
                        .hide();

                    $(".slug-error")
                        .html("")
                        .hide();
                }
            },


            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            error: function(xhr)
            {
                /*
                |--------------------------------------------------------------------------
                | Enable Submit
                |--------------------------------------------------------------------------
                */

                $("#submitBtn").prop(
                    "disabled",
                    false
                );


                /*
                |--------------------------------------------------------------------------
                | Laravel Validation Error
                |--------------------------------------------------------------------------
                */

                if (xhr.status === 422)
                {
                    let errors =
                        xhr.responseJSON.errors;

                    showErrors(errors);
                }
            }

        });

    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ENGLISH FIELD ERROR WHEN USER TYPES
|--------------------------------------------------------------------------
*/

$("#name").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".name-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ARABIC NAME ERROR
|--------------------------------------------------------------------------
*/

$("#name_ar").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".name_ar-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ARABIC DESCRIPTION ERROR
|--------------------------------------------------------------------------
*/

$("textarea[name='description_ar']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".description_ar-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ARABIC META TITLE ERROR
|--------------------------------------------------------------------------
*/

$("input[name='meta_title_ar']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".meta_title_ar-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ARABIC META DESCRIPTION ERROR
|--------------------------------------------------------------------------
*/

$("textarea[name='meta_description_ar']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".meta_description_ar-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ARABIC META KEYWORDS ERROR
|--------------------------------------------------------------------------
*/

$("textarea[name='meta_keywords_ar']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".meta_keywords_ar-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ENGLISH DESCRIPTION ERROR
|--------------------------------------------------------------------------
*/

$("textarea[name='description']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".description-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ENGLISH META TITLE ERROR
|--------------------------------------------------------------------------
*/

$("input[name='meta_title']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".meta_title-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ENGLISH META DESCRIPTION ERROR
|--------------------------------------------------------------------------
*/

$("textarea[name='meta_description']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".meta_description-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| CLEAR ENGLISH META KEYWORDS ERROR
|--------------------------------------------------------------------------
*/

$("textarea[name='meta_keywords']").on(
    "input",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".meta_keywords-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| STATUS CHANGE
|--------------------------------------------------------------------------
*/

$("#status").on(
    "change",
    function()
    {
        $(this)
            .removeClass("is-invalid");

        $(".status-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| IMAGE ERROR CLEAR
|--------------------------------------------------------------------------
*/

$("#image").on(
    "click",
    function()
    {
        $("#image")
            .removeClass("is-invalid");

        $("#image_id")
            .removeClass("is-invalid");

        $(".image_id-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| LANGUAGE TAB MEMORY
|--------------------------------------------------------------------------
*/

$(document).ready(function()
{
    /*
    |--------------------------------------------------------------------------
    | Get Saved Language
    |--------------------------------------------------------------------------
    */

    let language =
        localStorage.getItem(
            "category_language"
        );


    /*
    |--------------------------------------------------------------------------
    | Default English
    |--------------------------------------------------------------------------
    */

    if (!language)
    {
        language = "en";

        localStorage.setItem(
            "category_language",
            "en"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Open Saved Tab
    |--------------------------------------------------------------------------
    */

    if (language === "ar")
    {
        $("#arabic-tab").tab("show");
    }
    else
    {
        $("#english-tab").tab("show");
    }


    /*
    |--------------------------------------------------------------------------
    | Save Selected Tab
    |--------------------------------------------------------------------------
    */

    $('a[data-toggle="tab"]').on(
        "shown.bs.tab",
        function(e)
        {
            let target =
                $(e.target).attr("href");


            /*
            |--------------------------------------------------------------------------
            | Arabic
            |--------------------------------------------------------------------------
            */

            if (target === "#arabic")
            {
                localStorage.setItem(
                    "category_language",
                    "ar"
                );
            }


            /*
            |--------------------------------------------------------------------------
            | English
            |--------------------------------------------------------------------------
            */

            else
            {
                localStorage.setItem(
                    "category_language",
                    "en"
                );
            }
        }
    );

});

</script>

@endsection
