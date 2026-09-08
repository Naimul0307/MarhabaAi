@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">
                    HERO SLIDES / Edit
                </h1>
            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('heroSlideList') }}">
                            Hero Slides
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


<!-- Main Content -->
<section class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="card">


                    <!-- ===================================================== -->
                    <!-- CARD HEADER -->
                    <!-- ===================================================== -->

                    <div class="card-header">

                        <a
                            href="{{ route('heroSlideList') }}"
                            class="btn btn-primary">

                            Back

                        </a>

                    </div>


                    <!-- ===================================================== -->
                    <!-- FORM -->
                    <!-- ===================================================== -->

                    <form
                        action="{{ route('heroSlide.update', $heroSlide->id) }}"
                        method="POST"
                        id="editHeroSlideForm"
                        enctype="multipart/form-data">

                        @csrf


                        <div class="card-body">


                            <!-- ================================================= -->
                            <!-- LANGUAGE TABS -->
                            <!-- ================================================= -->

                            <ul
                                class="nav nav-tabs"
                                id="heroSlideTabs"
                                role="tablist">


                                <!-- English -->
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


                            <!-- ================================================= -->
                            <!-- TAB CONTENT -->
                            <!-- ================================================= -->

                            <div
                                class="tab-content mt-3"
                                id="heroSlideTabContent">


                                <!-- ============================================= -->
                                <!-- ENGLISH -->
                                <!-- ============================================= -->

                                <div
                                    class="tab-pane fade"
                                    id="english"
                                    role="tabpanel">


                                    <!-- English Name -->
                                    <div class="form-group">

                                        <label for="name">

                                            English Name

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control"
                                            value="{{ old('name', $heroSlide->name) }}"
                                            placeholder="Enter English name"
                                            autocomplete="off">


                                        <div
                                            class="invalid-feedback"
                                            id="name-error">
                                        </div>

                                    </div>


                                    <!-- Slug -->
                                    <div class="form-group">

                                        <label for="slug">

                                            Slug

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <input
                                            type="text"
                                            name="slug"
                                            id="slug"
                                            class="form-control"
                                            value="{{ old('slug', $heroSlide->slug) }}"
                                            readonly>


                                        <div
                                            class="invalid-feedback"
                                            id="slug-error">
                                        </div>

                                    </div>


                                </div>


                                <!-- ============================================= -->
                                <!-- ARABIC -->
                                <!-- ============================================= -->

                                <div
                                    class="tab-pane fade"
                                    id="arabic"
                                    role="tabpanel"
                                    dir="rtl"
                                    lang="ar">


                                    <!-- Arabic Name -->
                                    <div class="form-group text-right">

                                        <label for="name_ar">

                                            اسم الشريحة

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <input
                                            type="text"
                                            name="name_ar"
                                            id="name_ar"
                                            class="form-control text-right"
                                            value="{{ old('name_ar', $heroSlide->name_ar) }}"
                                            placeholder="أدخل اسم الشريحة"
                                            dir="rtl"
                                            lang="ar"
                                            autocomplete="off">


                                        <div
                                            class="invalid-feedback text-right"
                                            id="name_ar-error">
                                        </div>

                                    </div>


                                </div>


                            </div>


                            <!-- ================================================= -->
                            <!-- IMAGE -->
                            <!-- ================================================= -->

                            <div class="form-group mt-4">

                                <label>
                                    Image
                                </label>


                                <!-- Dropzone -->
                                <div
                                    id="image"
                                    class="dropzone">


                                    <div class="dz-message">

                                        Drop image here or click to upload

                                    </div>


                                </div>


                                <!-- Hidden Image ID -->
                                <input
                                    type="hidden"
                                    name="image_id"
                                    id="image_id"
                                    value="">


                                <!-- Existing Image -->
                                @if(!empty($heroSlide->image))

                                    <div
                                        class="mt-3"
                                        id="existingImageContainer">


                                        <label>
                                            Current Image
                                        </label>


                                        <div>

                                            <img
                                                src="{{ asset('uploads/hero_slides/thumb/large/' . $heroSlide->image) }}"
                                                alt="Hero Slide"
                                                width="200"
                                                class="img-thumbnail"
                                                style="object-fit: cover;">

                                        </div>


                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm mt-2"
                                            id="removeImageBtn">

                                            Remove Image

                                        </button>


                                    </div>

                                @endif

                            </div>


                            <!-- ================================================= -->
                            <!-- STATUS -->
                            <!-- ================================================= -->

                            <div class="form-group">

                                <label for="status">
                                    Status
                                </label>


                                <select
                                    name="status"
                                    id="status"
                                    class="form-control">


                                    <option
                                        value="1"
                                        {{ old('status', $heroSlide->status) == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>


                                    <option
                                        value="0"
                                        {{ old('status', $heroSlide->status) == 0 ? 'selected' : '' }}>

                                        Block

                                    </option>


                                </select>


                                <div
                                    class="invalid-feedback"
                                    id="status-error">
                                </div>

                            </div>


                        </div>


                        <!-- ===================================================== -->
                        <!-- CARD FOOTER -->
                        <!-- ===================================================== -->

                        <div class="card-footer">


                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="updateBtn">

                                Update

                            </button>


                            <a
                                href="{{ route('heroSlideList') }}"
                                class="btn btn-secondary">

                                Cancel

                            </a>


                        </div>


                    </form>

                </div>

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


/*
|--------------------------------------------------------------------------
| Current Submitted Language
|--------------------------------------------------------------------------
*/

let submittedLanguage = 'en';


$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | Language Memory
    |--------------------------------------------------------------------------
    */

    let language =
        localStorage.getItem(
            'hero_slide_language'
        );


    /*
    |--------------------------------------------------------------------------
    | Default Language
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
    | Open Saved Language
    |--------------------------------------------------------------------------
    */

    if (language === 'ar') {

        $('#arabic-tab').tab('show');

    } else {

        $('#english-tab').tab('show');

    }


    /*
    |--------------------------------------------------------------------------
    | Remember Language When Tab Changes
    |--------------------------------------------------------------------------
    */

    $('a[data-toggle="tab"]').on(
        'shown.bs.tab',
        function (e) {

            let target =
                $(e.target).attr('href');


            if (target === '#arabic') {

                localStorage.setItem(
                    'hero_slide_language',
                    'ar'
                );

            } else {

                localStorage.setItem(
                    'hero_slide_language',
                    'en'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Dropzone
    |--------------------------------------------------------------------------
    */

    let myDropzone =
        new Dropzone(
            "#image",
            {

                url: "{{ route('tempUpload') }}",

                paramName: "file",

                maxFiles: 1,

                acceptedFiles:
                    "image/jpeg,image/png,image/gif,image/webp,image/avif",

                addRemoveLinks: true,


                headers: {

                    'X-CSRF-TOKEN':
                        $('meta[name="_token"]').attr('content')

                },


                success: function (
                    file,
                    response
                ) {


                    if (
                        response.status == 200
                    ) {

                        $('#image_id').val(
                            response.image_id
                        );

                    }

                },


                error: function (
                    file,
                    response
                ) {

                    console.log(response);

                },


                removedfile: function (
                    file
                ) {

                    $('#image_id').val('');


                    if (
                        file.previewElement != null
                    ) {

                        file.previewElement.remove();

                    }

                }

            }
        );


    /*
    |--------------------------------------------------------------------------
    | Remove Existing Image
    |--------------------------------------------------------------------------
    */

    $('#removeImageBtn').click(
        function () {


            if (
                !confirm(
                    'Are you sure you want to remove this image?'
                )
            ) {

                return;

            }


            $.ajax({

                url:
                    "{{ route('heroSlide.remove.image', $heroSlide->id) }}",

                type: "POST",


                data: {

                    image:
                        "{{ $heroSlide->image }}",

                    _token:
                        $('meta[name="_token"]').attr('content')

                },


                dataType: "json",


                success: function (
                    response
                ) {


                    if (
                        response.status == 200
                    ) {

                        $('#existingImageContainer')
                            .remove();

                    } else {

                        alert(
                            response.message ||
                            'Unable to remove image.'
                        );

                    }

                },


                error: function (
                    xhr
                ) {

                    console.log(
                        xhr.responseText
                    );


                    alert(
                        'Something went wrong while removing image.'
                    );

                }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Generate Slug
    |--------------------------------------------------------------------------
    |
    | Slug is generated ONLY from English name.
    |
    */

    $('#name').on(
        'keyup change',
        function () {


            let name =
                $(this).val().trim();


            /*
            |--------------------------------------------------------------------------
            | Empty Name
            |--------------------------------------------------------------------------
            */

            if (name.length === 0) {

                $('#slug').val('');

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Generate Slug
            |--------------------------------------------------------------------------
            */

            $.ajax({

                url:
                    "{{ route('heroSlide.slug') }}",

                type: "GET",


                data: {

                    name: name

                },


                dataType: "json",


                success: function (
                    response
                ) {


                    if (
                        response.status === true
                    ) {

                        $('#slug').val(
                            response.slug
                        );


                        $('#slug')
                            .removeClass(
                                'is-invalid'
                            );


                        $('#slug-error')
                            .html('');

                    }

                }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove English Error While Typing
    |--------------------------------------------------------------------------
    */

    $('#name').on(
        'input',
        function () {

            $(this).removeClass(
                'is-invalid'
            );

            $('#name-error').html('');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove Arabic Error While Typing
    |--------------------------------------------------------------------------
    */

    $('#name_ar').on(
        'input',
        function () {

            $(this).removeClass(
                'is-invalid'
            );

            $('#name_ar-error').html('');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove Slug Error
    |--------------------------------------------------------------------------
    */

    $('#slug').on(
        'input',
        function () {

            $(this).removeClass(
                'is-invalid'
            );

            $('#slug-error').html('');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove Status Error
    |--------------------------------------------------------------------------
    */

    $('#status').on(
        'change',
        function () {

            $(this).removeClass(
                'is-invalid'
            );

            $('#status-error').html('');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Update Hero Slide
    |--------------------------------------------------------------------------
    */

    $('#editHeroSlideForm').submit(
        function (e) {

            e.preventDefault();


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | Capture the language BEFORE AJAX request.
            |--------------------------------------------------------------------------
            */

            let activeTab =
                $('#heroSlideTabs .nav-link.active')
                    .attr('href');


            if (
                activeTab === '#arabic'
            ) {

                submittedLanguage = 'ar';

            } else {

                submittedLanguage = 'en';

            }


            /*
            |--------------------------------------------------------------------------
            | Clear Previous Errors
            |--------------------------------------------------------------------------
            */

            $('.form-control')
                .removeClass(
                    'is-invalid'
                );


            $('.invalid-feedback')
                .html('');


            /*
            |--------------------------------------------------------------------------
            | Disable Button
            |--------------------------------------------------------------------------
            */

            let updateButton =
                $('#updateBtn');


            updateButton.prop(
                'disabled',
                true
            );


            updateButton.text(
                'Updating...'
            );


            /*
            |--------------------------------------------------------------------------
            | AJAX Request
            |--------------------------------------------------------------------------
            */

            $.ajax({

                url:
                    $(this).attr('action'),

                type: 'POST',

                data:
                    $(this).serialize(),

                dataType: 'json',


                /*
                |--------------------------------------------------------------------------
                | SUCCESS
                |--------------------------------------------------------------------------
                */

                success: function (
                    response
                ) {


                    /*
                    |--------------------------------------------------------------------------
                    | Successfully Updated
                    |--------------------------------------------------------------------------
                    */

                    if (
                        response.status == 200
                    ) {

                        window.location.href =
                            "{{ route('heroSlideList') }}";

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Validation Errors
                    |--------------------------------------------------------------------------
                    */

                    if (
                        response.errors
                    ) {


                        /*
                        |--------------------------------------------------------------------------
                        | English Name
                        |--------------------------------------------------------------------------
                        */

                        if (
                            response.errors.name
                        ) {

                            $('#name')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#name-error')
                                .html(
                                    response.errors.name[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Arabic Name
                        |--------------------------------------------------------------------------
                        */

                        if (
                            response.errors.name_ar
                        ) {

                            $('#name_ar')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#name_ar-error')
                                .html(
                                    response.errors.name_ar[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Slug
                        |--------------------------------------------------------------------------
                        */

                        if (
                            response.errors.slug
                        ) {

                            $('#slug')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#slug-error')
                                .html(
                                    response.errors.slug[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Status
                        |--------------------------------------------------------------------------
                        */

                        if (
                            response.errors.status
                        ) {

                            $('#status')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#status-error')
                                .html(
                                    response.errors.status[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | KEEP USER ON SUBMITTED TAB
                        |--------------------------------------------------------------------------
                        */

                        if (
                            submittedLanguage === 'ar' &&
                            response.errors.name_ar
                        ) {

                            $('#arabic-tab')
                                .tab('show');

                        }


                        else if (
                            submittedLanguage === 'en' &&
                            (
                                response.errors.name ||
                                response.errors.slug
                            )
                        ) {

                            $('#english-tab')
                                .tab('show');

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | If Submitted Tab Has No Error,
                        | Open The Tab Which Contains The Error
                        |--------------------------------------------------------------------------
                        */

                        else if (
                            response.errors.name_ar
                        ) {

                            $('#arabic-tab')
                                .tab('show');

                        }


                        else {

                            $('#english-tab')
                                .tab('show');

                        }

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Enable Button
                    |--------------------------------------------------------------------------
                    */

                    updateButton.prop(
                        'disabled',
                        false
                    );


                    updateButton.text(
                        'Update'
                    );

                },


                /*
                |--------------------------------------------------------------------------
                | AJAX ERROR
                |--------------------------------------------------------------------------
                */

                error: function (
                    xhr
                ) {


                    console.log(
                        xhr.responseText
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Enable Button
                    |--------------------------------------------------------------------------
                    */

                    updateButton.prop(
                        'disabled',
                        false
                    );


                    updateButton.text(
                        'Update'
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Laravel Validation Errors
                    |--------------------------------------------------------------------------
                    */

                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {


                        let errors =
                            xhr.responseJSON.errors;


                        /*
                        |--------------------------------------------------------------------------
                        | English Name
                        |--------------------------------------------------------------------------
                        */

                        if (
                            errors.name
                        ) {

                            $('#name')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#name-error')
                                .html(
                                    errors.name[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Arabic Name
                        |--------------------------------------------------------------------------
                        */

                        if (
                            errors.name_ar
                        ) {

                            $('#name_ar')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#name_ar-error')
                                .html(
                                    errors.name_ar[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Slug
                        |--------------------------------------------------------------------------
                        */

                        if (
                            errors.slug
                        ) {

                            $('#slug')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#slug-error')
                                .html(
                                    errors.slug[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Status
                        |--------------------------------------------------------------------------
                        */

                        if (
                            errors.status
                        ) {

                            $('#status')
                                .addClass(
                                    'is-invalid'
                                );


                            $('#status-error')
                                .html(
                                    errors.status[0]
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Keep Correct Tab Open
                        |--------------------------------------------------------------------------
                        */

                        if (
                            submittedLanguage === 'ar' &&
                            errors.name_ar
                        ) {

                            $('#arabic-tab')
                                .tab('show');

                        }


                        else if (
                            submittedLanguage === 'en' &&
                            (
                                errors.name ||
                                errors.slug
                            )
                        ) {

                            $('#english-tab')
                                .tab('show');

                        }


                        else if (
                            errors.name_ar
                        ) {

                            $('#arabic-tab')
                                .tab('show');

                        }


                        else {

                            $('#english-tab')
                                .tab('show');

                        }

                    }

                    else {

                        alert(
                            'Something went wrong. Please try again.'
                        );

                    }

                }

            });

        }
    );

});

</script>

@endsection

