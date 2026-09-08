@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    CATEGORY / Edit
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
                    action=""
                    method="post"
                    name="editCategoryForm"
                    id="editCategoryForm">

                    @csrf


                    <div class="card">


                        <!-- Card Header -->

                        <div class="card-header">

                            <a
                                href="{{ route('categoryList') }}"
                                class="btn btn-primary">

                                Back

                            </a>

                        </div>



                        <!-- Card Body -->

                        <div class="card-body">


                            <!-- LANGUAGE TABS -->

                            <ul
                                class="nav nav-tabs"
                                role="tablist">


                                <!-- ENGLISH -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        id="english-tab"
                                        data-toggle="tab"
                                        href="#english"
                                        role="tab">

                                        English

                                    </a>

                                </li>


                                <!-- ARABIC -->

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



                            <div class="tab-content mt-4">


                                {{-- ================================= --}}
                                {{-- ENGLISH --}}
                                {{-- ================================= --}}

                                <div
                                    class="tab-pane fade"
                                    id="english"
                                    role="tabpanel">


                                    <!-- NAME -->

                                    <div class="form-group">

                                        <label for="name">

                                            Name

                                        </label>


                                        <input
                                            type="text"
                                            value="{{ old('name', $category->name) }}"
                                            name="name"
                                            id="name"
                                            class="form-control">


                                        <p class="error name-error"></p>

                                    </div>


                                    {{-- SLUG --}}

                                    <div class="form-group mt-4">

                                        <label for="slug">

                                            Slug

                                        </label>


                                        <input
                                            type="text"
                                            readonly
                                            name="slug"
                                            id="slug"
                                            value="{{ $category->slug }}"
                                            class="form-control">


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
                                            placeholder="MAX 160 CHARACTERS">{{ old('description', $category->description) }}</textarea>

                                    </div>



                                    <!-- META TITLE -->

                                    <div class="form-group">

                                        <label for="meta_title">

                                            Meta Title

                                        </label>


                                        <input
                                            type="text"
                                            value="{{ old('meta_title', $category->meta_title) }}"
                                            name="meta_title"
                                            id="meta_title"
                                            class="form-control"
                                            placeholder="MAX 70 CHARACTERS">

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
                                            placeholder="MAX 160 CHARACTERS">{{ old('meta_description', $category->meta_description) }}</textarea>

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
                                            placeholder="MAX 160 CHARACTERS">{{ old('meta_keywords', $category->meta_keywords) }}</textarea>

                                    </div>

                                </div>



                                {{-- ================================= --}}
                                {{-- ARABIC --}}
                                {{-- ================================= --}}

                                <div
                                    class="tab-pane fade"
                                    id="arabic"
                                    role="tabpanel">


                                    <!-- ARABIC NAME -->

                                    <div class="form-group">

                                        <label for="name_ar">

                                            الاسم بالعربية

                                        </label>


                                        <input
                                            type="text"
                                            value="{{ old('name_ar', $category->name_ar) }}"
                                            name="name_ar"
                                            id="name_ar"
                                            class="form-control"
                                            dir="rtl"
                                            placeholder="أدخل اسم الفئة">


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
                                            placeholder="أدخل وصف الفئة">{{ old('description_ar', $category->description_ar) }}</textarea>

                                    </div>



                                    <!-- ARABIC META TITLE -->

                                    <div class="form-group">

                                        <label for="meta_title_ar">

                                            عنوان Meta

                                        </label>


                                        <input
                                            type="text"
                                            value="{{ old('meta_title_ar', $category->meta_title_ar) }}"
                                            name="meta_title_ar"
                                            id="meta_title_ar"
                                            class="form-control"
                                            dir="rtl"
                                            placeholder="عنوان SEO">

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
                                            placeholder="وصف SEO">{{ old('meta_description_ar', $category->meta_description_ar) }}</textarea>

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
                                            placeholder="الكلمات المفتاحية">{{ old('meta_keywords_ar', $category->meta_keywords_ar) }}</textarea>

                                    </div>

                                </div>

                            </div>






                            {{-- IMAGE --}}

                            <div class="form-group">

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



                                        @if(!empty($category->image))


                                            <img
                                                class="img-thumbnail my-4"
                                                src="{{ asset('uploads/categories/thumb/large/'.$category->image) }}"
                                                width="300">


                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm remove-image"
                                                data-image="{{ $category->image }}">

                                                Remove

                                            </button>


                                        @endif

                                    </div>

                                </div>

                            </div>



                            {{-- STATUS --}}

                            <div class="form-group mt-4">

                                <label for="status">

                                    Status

                                </label>


                                <select
                                    name="status"
                                    id="status"
                                    class="form-control">


                                    <option
                                        value="1"
                                        {{ $category->status == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>


                                    <option
                                        value="0"
                                        {{ $category->status == 0 ? 'selected' : '' }}>

                                        Block

                                    </option>


                                </select>

                            </div>



                            <!-- SUBMIT -->

                            <button
                                type="submit"
                                name="submit"
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
    | SHOW VALIDATION ERRORS
    |--------------------------------------------------------------------------
    */

/*
|--------------------------------------------------------------------------
| SHOW VALIDATION ERRORS
|--------------------------------------------------------------------------
*/

function showErrors(errors)
{
    clearErrors();


    /*
    |--------------------------------------------------------------------------
    | ENGLISH NAME ERROR
    |--------------------------------------------------------------------------
    */

    if (
        errors.name &&
        errors.name.length > 0
    ) {

        $('#name')
            .addClass('is-invalid');

        $('.name-error')
            .html(errors.name[0])
            .show();
    }


    /*
    |--------------------------------------------------------------------------
    | ARABIC NAME ERROR
    |--------------------------------------------------------------------------
    */

    if (
        errors.name_ar &&
        errors.name_ar.length > 0
    ) {

        $('#name_ar')
            .addClass('is-invalid');

        $('.name_ar-error')
            .html(errors.name_ar[0])
            .show();

        /*
        |--------------------------------------------------------------------------
        | AUTOMATICALLY OPEN ARABIC TAB
        |--------------------------------------------------------------------------
        */

        $('#arabic-tab').tab('show');

        localStorage.setItem(
            'category_language',
            'ar'
        );

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | SLUG ERROR
    |--------------------------------------------------------------------------
    */

    if (
        errors.slug &&
        errors.slug.length > 0
    ) {

        $('#slug')
            .addClass('is-invalid');

        $('.slug-error')
            .html(errors.slug[0])
            .show();

        /*
        |--------------------------------------------------------------------------
        | OPEN ENGLISH TAB
        |--------------------------------------------------------------------------
        */

        $('#english-tab').tab('show');

        localStorage.setItem(
            'category_language',
            'en'
        );

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | DEFAULT TAB
    |--------------------------------------------------------------------------
    */

    $('#english-tab').tab('show');

    localStorage.setItem(
        'category_language',
        'en'
    );
}
    /*
    |--------------------------------------------------------------------------
    | CLEAR VALIDATION ERRORS
    |--------------------------------------------------------------------------
    */
/*
|--------------------------------------------------------------------------
| CLEAR VALIDATION ERRORS
|--------------------------------------------------------------------------
*/

function clearErrors()
{
    $('.error')
        .html('')
        .hide();

    $('.form-control')
        .removeClass('is-invalid');
}
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


        success: function(file, response) {

            $("#image_id").val(response.id);

        }

    });



    /*
    |--------------------------------------------------------------------------
    | REMOVE IMAGE
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.remove-image', function() {


        let imageName =
            $(this).data('image');


        $('#image_id').val('');


        $(this)
            .prev('img')
            .remove();


        $(this)
            .remove();



        $.ajax({

            url:
                "{{ route('category.remove.image', $category->id) }}",


            type: 'POST',


            data: {

                image: imageName,

                _token:
                    $('meta[name="_token"]').attr('content')

            },


            success: function(response) {


                if (response.status === 200) {

                    console.log(
                        'Main image removed successfully'
                    );

                } else {

                    console.log(
                        'Error removing image: ' +
                        response.message
                    );

                }

            },


            error: function(
                jqXHR,
                textStatus,
                errorThrown
            ) {

                console.log(
                    'AJAX Error: ' +
                    textStatus
                );

            }

        });

    });



    /*
    |--------------------------------------------------------------------------
    | UPDATE CATEGORY
    |--------------------------------------------------------------------------
    */

    $("#editCategoryForm").submit(function(event) {

        event.preventDefault();


        const form =
            $(this);


        const button =
            form.find("button[type='submit']");


        /*
        |--------------------------------------------------------------------------
        | CLEAR OLD ERRORS
        |--------------------------------------------------------------------------
        */

        clearErrors();


        /*
        |--------------------------------------------------------------------------
        | DISABLE BUTTON
        |--------------------------------------------------------------------------
        */

        button.prop(
            'disabled',
            true
        );


        $.ajax({

            url:
                "{{ route('category.update', $category->id) }}",


            type:
                'POST',


            data:
                form.serialize(),


            dataType:
                'json',


            success: function(response) {


                button.prop(
                    'disabled',
                    false
                );


                /*
                |--------------------------------------------------------------------------
                | SUCCESS
                |--------------------------------------------------------------------------
                */

                if (
                    response.status == 200
                ) {

                    window.location.href =
                        "{{ route('categoryList') }}";

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | VALIDATION RESPONSE
                |--------------------------------------------------------------------------
                */

                if (
                    response.errors
                ) {

                    showErrors(
                        response.errors
                    );

                }

            },


            /*
            |--------------------------------------------------------------------------
            | AJAX ERROR
            |--------------------------------------------------------------------------
            */

            error: function(xhr) {


                button.prop(
                    'disabled',
                    false
                );


                /*
                |--------------------------------------------------------------------------
                | LARAVEL VALIDATION ERROR
                |--------------------------------------------------------------------------
                */

                if (
                    xhr.status === 422 &&
                    xhr.responseJSON &&
                    xhr.responseJSON.errors
                ) {

                    showErrors(
                        xhr.responseJSON.errors
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | OTHER ERROR
                |--------------------------------------------------------------------------
                */

                console.log(
                    'Update Error:',
                    xhr.responseText
                );


                alert(
                    'An error occurred while updating the category.'
                );

            }

        });

    });



    /*
    |--------------------------------------------------------------------------
    | SLUG GENERATION
    |--------------------------------------------------------------------------
    */

    let slugTimer = null;


    $("#name").on('input', function() {


        const name =
            $(this)
                .val()
                .trim();


        /*
        |--------------------------------------------------------------------------
        | CLEAR NAME ERROR
        |--------------------------------------------------------------------------
        */

        $('#name')
            .removeClass('is-invalid');

        $('.name-error')
            .html('')
            .hide();


        /*
        |--------------------------------------------------------------------------
        | NAME EMPTY
        |--------------------------------------------------------------------------
        |
        | If user removes the name,
        | slug should also become empty.
        |
        */

        if (
            name === ''
        ) {

            clearTimeout(
                slugTimer
            );


            $('#slug')
                .val('');


            $('#slug')
                .removeClass(
                    'is-invalid'
                );


            $('.slug-error')
                .html('')
                .hide();


            return;

        }


        /*
        |--------------------------------------------------------------------------
        | CLEAR OLD SLUG ERROR
        |--------------------------------------------------------------------------
        */

        $('#slug')
            .removeClass('is-invalid');

        $('.slug-error')
            .html('')
            .hide();


        /*
        |--------------------------------------------------------------------------
        | STOP PREVIOUS REQUEST
        |--------------------------------------------------------------------------
        */

        clearTimeout(
            slugTimer
        );


        /*
        |--------------------------------------------------------------------------
        | WAIT BEFORE GENERATING SLUG
        |--------------------------------------------------------------------------
        */

        slugTimer =
            setTimeout(function() {


                const button =
                    $("#editCategoryForm")
                        .find(
                            "button[type='submit']"
                        );


                button.prop(
                    'disabled',
                    true
                );


                $.ajax({

                    url:
                        "{{ route('category.slug') }}",


                    type:
                        'GET',


                    data: {

                        name:
                            name,

                        id:
                            "{{ $category->id }}"

                    },


                    dataType:
                        'json',


                    success:
                        function(response) {


                            if (
                                response.status == 200
                            ) {

                                $("#slug")
                                    .val(
                                        response.slug
                                    );

                            }


                        },


                    error:
                        function(xhr) {


                            console.log(
                                'Slug Error:',
                                xhr.responseText
                            );


                        },


                    complete:
                        function() {


                            button.prop(
                                'disabled',
                                false
                            );


                        }

                });


            }, 300);

    });



    /*
    |--------------------------------------------------------------------------
    | LANGUAGE TAB MEMORY
    |--------------------------------------------------------------------------
    */

    $(document).ready(function() {


        /*
        |--------------------------------------------------------------------------
        | GET SAVED LANGUAGE
        |--------------------------------------------------------------------------
        */

        let language =
            localStorage.getItem(
                'category_language'
            );


        /*
        |--------------------------------------------------------------------------
        | DEFAULT ENGLISH
        |--------------------------------------------------------------------------
        */

        if (!language) {

            language = 'en';


            localStorage.setItem(
                'category_language',
                'en'
            );

        }



        /*
        |--------------------------------------------------------------------------
        | OPEN CORRECT TAB
        |--------------------------------------------------------------------------
        */

        if (
            language === 'ar'
        ) {

            $('#arabic-tab')
                .tab('show');

        } else {

            $('#english-tab')
                .tab('show');

        }



        /*
        |--------------------------------------------------------------------------
        | SAVE LANGUAGE WHEN TAB CHANGES
        |--------------------------------------------------------------------------
        */

        $('a[data-toggle="tab"]').on(
            'shown.bs.tab',
            function(e) {


                let target =
                    $(e.target)
                        .attr('href');


                if (
                    target === '#arabic'
                ) {


                    localStorage.setItem(
                        'category_language',
                        'ar'
                    );


                } else {


                    localStorage.setItem(
                        'category_language',
                        'en'
                    );

                }

            }
        );

    });


</script>

@endsection
