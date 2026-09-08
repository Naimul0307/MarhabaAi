@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">


    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">
                SUB CATEGORY / Create
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

<section class="content h-100">


<div class="container-fluid h-100">

    <div class="row">

        <div class="col-md-12">

            <form
                action="{{ route('subCategory.save') }}"
                method="POST"
                name="createSubCategoryForm"
                id="createSubCategoryForm"
            >

                @csrf


                <div class="card">


                    <!-- ================================================= -->
                    <!-- CARD HEADER -->
                    <!-- ================================================= -->

                    <div class="card-header">

                        <a
                            href="{{ route('subCategoryList') }}"
                            class="btn btn-primary"
                        >
                            Back
                        </a>

                    </div>


                    <!-- ================================================= -->
                    <!-- CARD BODY -->
                    <!-- ================================================= -->

                    <div class="card-body">


                        <!-- ================================================= -->
                        <!-- LANGUAGE TABS -->
                        <!-- ================================================= -->

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


                        <div class="tab-content mt-4">


                            <!-- ================================================= -->
                            <!-- ENGLISH TAB -->
                            <!-- ================================================= -->

                            <div
                                class="tab-pane fade show active"
                                id="english"
                                role="tabpanel"
                            >


                                <!-- CATEGORY -->

                                <div class="form-group">

                                    <label for="category_id">
                                        Category
                                    </label>


                                    <select
                                        name="category_id"
                                        id="category_id"
                                        class="form-control"
                                    >

                                        <option value="">
                                            Select a category
                                        </option>


                                        @foreach($categories as $category)

                                            <option
                                                value="{{ $category->id }}"
                                            >
                                                {{ $category->name }}
                                            </option>

                                        @endforeach

                                    </select>


                                    <!-- English + Arabic category errors -->

                                    <p class="error category_id-error"></p>

                                </div>


                                <!-- NAME -->

                                <div class="form-group">

                                    <label for="name">
                                        Name
                                    </label>


                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                    >


                                    <p class="error name-error"></p>

                                </div>

                        <!-- ================================================= -->
                        <!-- SLUG -->
                        <!-- ================================================= -->

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
                            >


                            <p class="error slug-error"></p>

                        </div>

                                <!-- DESCRIPTION -->

                                <div class="form-group">

                                    <label for="description">
                                        Description
                                    </label>


                                    <textarea
                                        name="description"
                                        id="description"
                                        rows="7"
                                        class="form-control"
                                        placeholder="MAX 160 CHARACTERS"
                                    ></textarea>


                                    <p class="error description-error"></p>

                                </div>


                                <!-- META TITLE -->

                                <div class="form-group">

                                    <label for="meta_title">
                                        Meta Title
                                    </label>


                                    <input
                                        type="text"
                                        name="meta_title"
                                        id="meta_title"
                                        class="form-control"
                                        placeholder="MAX 70 CHARACTERS"
                                    >


                                    <p class="error meta_title-error"></p>

                                </div>


                                <!-- META DESCRIPTION -->

                                <div class="form-group">

                                    <label for="meta_description">
                                        Meta Description
                                    </label>


                                    <textarea
                                        name="meta_description"
                                        id="meta_description"
                                        rows="7"
                                        class="form-control"
                                        placeholder="MAX 160 CHARACTERS"
                                    ></textarea>


                                    <p class="error meta_description-error"></p>

                                </div>


                                <!-- META KEYWORDS -->

                                <div class="form-group">

                                    <label for="meta_keywords">
                                        Meta Keywords
                                    </label>


                                    <textarea
                                        name="meta_keywords"
                                        id="meta_keywords"
                                        rows="5"
                                        class="form-control"
                                        placeholder="MAX 160 CHARACTERS"
                                    ></textarea>


                                    <p class="error meta_keywords-error"></p>

                                </div>


                            </div>


                            <!-- ================================================= -->
                            <!-- ARABIC TAB -->
                            <!-- ================================================= -->

                            <div
                                class="tab-pane fade"
                                id="arabic"
                                role="tabpanel"
                            >


                                <!-- ARABIC CATEGORY -->

                                <div class="form-group">

                                    <label for="category_id_ar">
                                        الفئة
                                    </label>


                                    <select
                                        name="category_id_ar"
                                        id="category_id_ar"
                                        class="form-control"
                                        dir="rtl"
                                    >

                                        <option value="">
                                            اختر الفئة
                                        </option>


                                        @foreach($categories as $category)

                                            <option
                                                value="{{ $category->id }}"
                                            >
                                                {{ $category->name_ar ?: $category->name }}
                                            </option>

                                        @endforeach

                                    </select>


                                    <!-- Arabic category error -->

                                    <p class="error category_id_ar-error"></p>

                                </div>


                                <!-- ARABIC NAME -->

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
                                        placeholder="أدخل اسم الفئة الفرعية"
                                    >


                                    <p class="error name_ar-error"></p>

                                </div>


                                <!-- ARABIC DESCRIPTION -->

                                <div class="form-group">

                                    <label for="description_ar">
                                        الوصف
                                    </label>


                                    <textarea
                                        name="description_ar"
                                        id="description_ar"
                                        rows="7"
                                        class="form-control"
                                        dir="rtl"
                                        placeholder="أدخل وصف الفئة الفرعية"
                                    ></textarea>


                                    <p class="error description_ar-error"></p>

                                </div>


                                <!-- ARABIC META TITLE -->

                                <div class="form-group">

                                    <label for="meta_title_ar">
                                        عنوان Meta
                                    </label>


                                    <input
                                        type="text"
                                        name="meta_title_ar"
                                        id="meta_title_ar"
                                        class="form-control"
                                        dir="rtl"
                                        placeholder="عنوان SEO"
                                    >


                                    <p class="error meta_title_ar-error"></p>

                                </div>


                                <!-- ARABIC META DESCRIPTION -->

                                <div class="form-group">

                                    <label for="meta_description_ar">
                                        وصف Meta
                                    </label>


                                    <textarea
                                        name="meta_description_ar"
                                        id="meta_description_ar"
                                        rows="7"
                                        class="form-control"
                                        dir="rtl"
                                        placeholder="وصف SEO"
                                    ></textarea>


                                    <p class="error meta_description_ar-error"></p>

                                </div>


                                <!-- ARABIC META KEYWORDS -->

                                <div class="form-group">

                                    <label for="meta_keywords_ar">
                                        الكلمات المفتاحية
                                    </label>


                                    <textarea
                                        name="meta_keywords_ar"
                                        id="meta_keywords_ar"
                                        rows="5"
                                        class="form-control"
                                        dir="rtl"
                                        placeholder="الكلمات المفتاحية"
                                    ></textarea>


                                    <p class="error meta_keywords_ar-error"></p>

                                </div>


                            </div>

                        </div>




                        <!-- ================================================= -->
                        <!-- STATUS -->
                        <!-- ================================================= -->

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


                        <!-- ================================================= -->
                        <!-- SUBMIT -->
                        <!-- ================================================= -->

                        <button
                            type="submit"
                            id="submitBtn"
                            name="submit"
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

    $(".error").html("").hide();


    /*
    |--------------------------------------------------------------------------
    | Remove Invalid Class
    |--------------------------------------------------------------------------
    */

    $(".form-control").removeClass("is-invalid");
}



/*
|--------------------------------------------------------------------------
| SHOW VALIDATION ERRORS
|--------------------------------------------------------------------------
*/

function showErrors(errors)
{
    /*
    |--------------------------------------------------------------------------
    | Clear Previous Errors
    |--------------------------------------------------------------------------
    */

    clearErrors();


    /*
    |--------------------------------------------------------------------------
    | Display Validation Errors
    |--------------------------------------------------------------------------
    */

    $.each(errors, function(field, messages)
    {
        /*
        |--------------------------------------------------------------------------
        | Add Red Border
        |--------------------------------------------------------------------------
        */

        $("#" + field).addClass("is-invalid");


        /*
        |--------------------------------------------------------------------------
        | Show Error Message
        |--------------------------------------------------------------------------
        */

        $("." + field + "-error")
            .html(messages[0])
            .show();
    });



    /*
    |--------------------------------------------------------------------------
    | CATEGORY ERROR
    |
    | category_id is a shared database field.
    | Show the same error in BOTH English and Arabic.
    |--------------------------------------------------------------------------
    */

    if (errors.category_id)
    {
        /*
        |--------------------------------------------------------------------------
        | English Category
        |--------------------------------------------------------------------------
        */

        $("#category_id")
            .addClass("is-invalid");

        $(".category_id-error")
            .html(errors.category_id[0])
            .show();


        /*
        |--------------------------------------------------------------------------
        | Arabic Category
        |--------------------------------------------------------------------------
        */

        $("#category_id_ar")
            .addClass("is-invalid");

        $(".category_id_ar-error")
            .html(errors.category_id[0])
            .show();
    }



    /*
    |--------------------------------------------------------------------------
    | KEEP USER ON THE TAB THEY WERE USING
    |--------------------------------------------------------------------------
    */

    let activeLanguage =
        localStorage.getItem(
            "sub_category_language"
        );


    if (activeLanguage === "ar")
    {
        $("#arabic-tab").tab("show");
    }
    else
    {
        $("#english-tab").tab("show");
    }
}



/*
|--------------------------------------------------------------------------
| CREATE SUB CATEGORY
|--------------------------------------------------------------------------
*/

$("#createSubCategoryForm").submit(function(event)
{
    event.preventDefault();


    /*
    |--------------------------------------------------------------------------
    | Submit Button
    |--------------------------------------------------------------------------
    */

    const button =
        $("#submitBtn");


    /*
    |--------------------------------------------------------------------------
    | Disable Submit
    |--------------------------------------------------------------------------
    */

    button.prop(
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
            '{{ route("subCategory.save") }}',

        type:
            'POST',

        dataType:
            'json',

        data:
            $("#createSubCategoryForm").serialize(),


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        success: function(response)
        {
            /*
            |--------------------------------------------------------------------------
            | Enable Button
            |--------------------------------------------------------------------------
            */

            button.prop(
                "disabled",
                false
            );


            /*
            |--------------------------------------------------------------------------
            | Successfully Created
            |--------------------------------------------------------------------------
            */

            if (response.status == 200)
            {
                window.location.href =
                    '{{ route("subCategoryList") }}';

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Validation Errors Returned With 200
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
        | ERROR
        |--------------------------------------------------------------------------
        */

        error: function(xhr)
        {
            /*
            |--------------------------------------------------------------------------
            | Enable Button
            |--------------------------------------------------------------------------
            */

            button.prop(
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
            | Other Error
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
        | AJAX SLUG REQUEST
        |--------------------------------------------------------------------------
        */

        $.ajax({

            url:
                '{{ route("subCategory.slug") }}',

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
                | Slug Generated
                |--------------------------------------------------------------------------
                */

                if (response.status == 200)
                {
                    /*
                    |--------------------------------------------------------------------------
                    | Set Slug
                    |--------------------------------------------------------------------------
                    */

                    $("#slug").val(
                        response.slug
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Remove Slug Invalid
                    |--------------------------------------------------------------------------
                    */

                    $("#slug")
                        .removeClass("is-invalid");


                    /*
                    |--------------------------------------------------------------------------
                    | Clear Slug Error
                    |--------------------------------------------------------------------------
                    */

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
| CATEGORY SYNC
|--------------------------------------------------------------------------
|
| English category and Arabic category use the SAME database field:
| category_id
|
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| ENGLISH CATEGORY -> ARABIC CATEGORY
|--------------------------------------------------------------------------
*/

$("#category_id").on(
    "change",
    function()
    {
        let value =
            $(this).val();


        /*
        |--------------------------------------------------------------------------
        | Sync Arabic Dropdown
        |--------------------------------------------------------------------------
        */

        $("#category_id_ar").val(
            value
        );


        /*
        |--------------------------------------------------------------------------
        | Remove Invalid Class
        |--------------------------------------------------------------------------
        */

        $("#category_id")
            .removeClass("is-invalid");

        $("#category_id_ar")
            .removeClass("is-invalid");


        /*
        |--------------------------------------------------------------------------
        | Clear Both Category Errors
        |--------------------------------------------------------------------------
        */

        $(".category_id-error")
            .html("")
            .hide();

        $(".category_id_ar-error")
            .html("")
            .hide();
    }
);



/*
|--------------------------------------------------------------------------
| ARABIC CATEGORY -> ENGLISH CATEGORY
|--------------------------------------------------------------------------
*/

$("#category_id_ar").on(
    "change",
    function()
    {
        let value =
            $(this).val();


        /*
        |--------------------------------------------------------------------------
        | Sync English Dropdown
        |--------------------------------------------------------------------------
        */

        $("#category_id").val(
            value
        );


        /*
        |--------------------------------------------------------------------------
        | Remove Invalid Class
        |--------------------------------------------------------------------------
        */

        $("#category_id")
            .removeClass("is-invalid");

        $("#category_id_ar")
            .removeClass("is-invalid");


        /*
        |--------------------------------------------------------------------------
        | Clear Both Category Errors
        |--------------------------------------------------------------------------
        */

        $(".category_id-error")
            .html("")
            .hide();

        $(".category_id_ar-error")
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
    let language =
        localStorage.getItem(
            "sub_category_language"
        );


    /*
    |--------------------------------------------------------------------------
    | Default Language
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
});



/*
|--------------------------------------------------------------------------
| SAVE ACTIVE LANGUAGE
|--------------------------------------------------------------------------
*/

$("#english-tab").on(
    "click",
    function()
    {
        localStorage.setItem(
            "sub_category_language",
            "en"
        );
    }
);


$("#arabic-tab").on(
    "click",
    function()
    {
        localStorage.setItem(
            "sub_category_language",
            "ar"
        );
    }
);


</script>

@endsection
