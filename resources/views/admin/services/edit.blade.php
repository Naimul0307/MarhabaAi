@extends('admin.layouts.app')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Services / Edit
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
                        Services
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

                <form
                    action="{{ route('service.edit.update', $service->id) }}"
                    method="POST"
                    id="editServiceForm"
                >

                    @csrf


                    <div class="card">


                        {{-- =====================================================
                        | HEADER
                        ====================================================== --}}

                        <div class="card-header">

                            <a
                                href="{{ route('serviceList') }}"
                                class="btn btn-primary"
                            >
                                Back
                            </a>

                        </div>


                        <div class="card-body">


                            {{-- =====================================================
                            | LANGUAGE TABS
                            ====================================================== --}}

                            <ul class="nav nav-tabs" id="serviceTabs">

                                <li class="nav-item">

                                    <a
                                        class="nav-link active"
                                        id="english-tab"
                                        data-toggle="tab"
                                        href="#english"
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
                                    >
                                        العربية
                                    </a>

                                </li>

                            </ul>


                            <div class="tab-content pt-4">


                                {{-- =====================================================
                                | ENGLISH TAB
                                ====================================================== --}}

                                <div
                                    class="tab-pane fade show active"
                                    id="english"
                                >


                                    {{-- Name --}}

                                    <div class="form-group">

                                        <label for="name">
                                            Name
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            value="{{ old('name', $service->name) }}"
                                            class="form-control"
                                        >

                                        <p class="error name-error"></p>

                                    </div>


                                    {{-- Slug --}}

                                    <div class="form-group">

                                        <label for="slug">
                                            Slug
                                        </label>

                                        <input
                                            type="text"
                                            readonly
                                            name="slug"
                                            id="slug"
                                            value="{{ old('slug', $service->slug) }}"
                                            class="form-control"
                                        >

                                        <p class="error slug-error"></p>

                                    </div>


                                    {{-- Category --}}

                                    <div class="form-group">

                                        <label for="category">
                                            Category
                                        </label>

                                        <select
                                            name="category"
                                            id="category"
                                            class="form-control"
                                        >

                                            <option value="">
                                                Select a category
                                            </option>

                                            @foreach($categories as $category)

                                                <option
                                                    value="{{ $category->id }}"
                                                    {{ $service->category_id == $category->id ? 'selected' : '' }}
                                                >
                                                    {{ $category->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <p class="error category-error"></p>

                                    </div>


                                    {{-- Sub Category --}}

                                    <div class="form-group">

                                        <label for="sub_category">
                                            Sub-Category
                                        </label>

                                        <select
                                            name="sub_category"
                                            id="sub_category"
                                            class="form-control"
                                        >

                                            <option value="">
                                                Select a sub-category
                                            </option>

                                            @foreach($sub_categories as $sub_category)

                                                <option
                                                    value="{{ $sub_category->id }}"
                                                    {{ $service->sub_category_id == $sub_category->id ? 'selected' : '' }}
                                                >
                                                    {{ $sub_category->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <p class="error sub_category-error"></p>

                                    </div>


                                    {{-- Description --}}

                                    <div class="form-group">

                                        <label for="description">
                                            Description
                                        </label>

                                        <textarea
                                            name="description"
                                            id="description"
                                            class="summernote"
                                        >{{ old('description', $service->description) }}</textarea>

                                        <p class="error description-error"></p>

                                    </div>


                                    {{-- Short Description --}}

                                    <div class="form-group">

                                        <label for="short_description">
                                            Short Description
                                        </label>

                                        <textarea
                                            name="short_description"
                                            id="short_description"
                                            rows="7"
                                            class="form-control"
                                        >{{ old('short_description', $service->short_desc) }}</textarea>

                                        <p class="error short_description-error"></p>

                                    </div>


                                    {{-- Meta Title --}}

                                    <div class="form-group">

                                        <label for="meta_title">
                                            Meta Title
                                        </label>

                                        <input
                                            type="text"
                                            name="meta_title"
                                            id="meta_title"
                                            value="{{ old('meta_title', $service->meta_title) }}"
                                            class="form-control"
                                            placeholder="MAX 70 CHARACTERS"
                                        >

                                        <p class="error meta_title-error"></p>

                                    </div>


                                    {{-- Meta Description --}}

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
                                        >{{ old('meta_description', $service->meta_description) }}</textarea>

                                        <p class="error meta_description-error"></p>

                                    </div>


                                    {{-- Meta Keywords --}}

                                    <div class="form-group">

                                        <label for="meta_keywords">
                                            Meta Keywords
                                        </label>

                                        <textarea
                                            name="meta_keywords"
                                            id="meta_keywords"
                                            rows="7"
                                            class="form-control"
                                            placeholder="MAX 160 CHARACTERS"
                                        >{{ old('meta_keywords', $service->meta_keywords) }}</textarea>

                                        <p class="error meta_keywords-error"></p>

                                    </div>


                                </div>


                                {{-- =====================================================
                                | ARABIC TAB
                                ====================================================== --}}

                                <div
                                    class="tab-pane fade"
                                    id="arabic"
                                >

                                    <div
                                        dir="rtl"
                                        style="text-align: right;"
                                    >


                                        {{-- Arabic Name --}}

                                        <div class="form-group">

                                            <label for="name_ar">
                                                الاسم
                                            </label>

                                            <input
                                                type="text"
                                                name="name_ar"
                                                id="name_ar"
                                                value="{{ old('name_ar', $service->name_ar) }}"
                                                class="form-control"
                                                dir="rtl"
                                            >

                                            <p class="error name_ar-error"></p>

                                        </div>


                                        {{-- Arabic Category --}}

                                        <div class="form-group">

                                            <label for="category_ar">
                                                الفئة
                                            </label>

                                            <select
                                                name="category_ar"
                                                id="category_ar"
                                                class="form-control"
                                                dir="rtl"
                                            >

                                                <option value="">
                                                    اختر الفئة
                                                </option>

                                                @foreach($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        {{ $service->category_id == $category->id ? 'selected' : '' }}
                                                    >
                                                        {{ $category->name_ar ?: $category->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <p class="error category_ar-error"></p>

                                        </div>


                                        {{-- Arabic Sub Category --}}

                                        <div class="form-group">

                                            <label for="sub_category_ar">
                                                الفئة الفرعية
                                            </label>

                                            <select
                                                name="sub_category_ar"
                                                id="sub_category_ar"
                                                class="form-control"
                                                dir="rtl"
                                            >

                                                <option value="">
                                                    اختر الفئة الفرعية
                                                </option>

                                                @foreach($sub_categories as $sub_category)

                                                    <option
                                                        value="{{ $sub_category->id }}"
                                                        {{ $service->sub_category_id == $sub_category->id ? 'selected' : '' }}
                                                    >
                                                        {{ $sub_category->name_ar ?: $sub_category->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <p class="error sub_category_ar-error"></p>

                                        </div>


                                        {{-- Arabic Description --}}

                                        <div class="form-group">

                                            <label for="description_ar">
                                                الوصف
                                            </label>

                                            <textarea
                                                name="description_ar"
                                                id="description_ar"
                                                class="summernote"
                                                dir="rtl"
                                            >{{ old('description_ar', $service->description_ar) }}</textarea>

                                            <p class="error description_ar-error"></p>

                                        </div>


                                        {{-- Arabic Short Description --}}

                                        <div class="form-group">

                                            <label for="short_description_ar">
                                                وصف قصير
                                            </label>

                                            <textarea
                                                name="short_description_ar"
                                                id="short_description_ar"
                                                rows="7"
                                                class="form-control"
                                                dir="rtl"
                                            >{{ old('short_description_ar', $service->short_desc_ar) }}</textarea>

                                            <p class="error short_description_ar-error"></p>

                                        </div>


                                        {{-- Arabic Meta Title --}}

                                        <div class="form-group">

                                            <label for="meta_title_ar">
                                                عنوان Meta
                                            </label>

                                            <input
                                                type="text"
                                                name="meta_title_ar"
                                                id="meta_title_ar"
                                                value="{{ old('meta_title_ar', $service->meta_title_ar) }}"
                                                class="form-control"
                                                dir="rtl"
                                                placeholder="حد أقصى 70 حرفًا"
                                            >

                                            <p class="error meta_title_ar-error"></p>

                                        </div>


                                        {{-- Arabic Meta Description --}}

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
                                                placeholder="حد أقصى 160 حرفًا"
                                            >{{ old('meta_description_ar', $service->meta_description_ar) }}</textarea>

                                            <p class="error meta_description_ar-error"></p>

                                        </div>


                                        {{-- Arabic Meta Keywords --}}

                                        <div class="form-group">

                                            <label for="meta_keywords_ar">
                                                كلمات Meta المفتاحية
                                            </label>

                                            <textarea
                                                name="meta_keywords_ar"
                                                id="meta_keywords_ar"
                                                rows="7"
                                                class="form-control"
                                                dir="rtl"
                                                placeholder="حد أقصى 160 حرفًا"
                                            >{{ old('meta_keywords_ar', $service->meta_keywords_ar) }}</textarea>

                                            <p class="error meta_keywords_ar-error"></p>

                                        </div>


                                    </div>

                                </div>

                            </div>


                            {{-- =====================================================
                            | COMMON FIELDS
                            ====================================================== --}}

                            <hr>

                            <h5 class="mb-3">
                                Common / Media
                            </h5>


                            {{-- Video Link --}}

                            <div class="form-group">

                                <label for="videos_link">
                                    Video Link
                                </label>

                                <input
                                    type="text"
                                    value="{{ old('videos_link', $service->videos_link) }}"
                                    name="videos_link"
                                    id="videos_link"
                                    class="form-control"
                                >

                                <p class="error videos_link-error"></p>

                            </div>


                            {{-- Additional Videos --}}

                            <div class="form-group">

                                <label>
                                    Additional Videos Links
                                </label>

                                <div id="additional_videos_links">

                                    @if(
                                        is_array($additional_videos_links)
                                        && count($additional_videos_links)
                                    )

                                        @foreach(
                                            $additional_videos_links
                                            as $link
                                        )

                                            <div class="input-group mb-2">

                                                <input
                                                    type="text"
                                                    name="additional_videos_links[]"
                                                    class="form-control"
                                                    value="{{ $link }}"
                                                    placeholder="Enter additional video link"
                                                >

                                                <div class="input-group-append">

                                                    <button
                                                        class="btn btn-outline-secondary remove-link"
                                                        type="button"
                                                    >
                                                        Remove
                                                    </button>

                                                </div>

                                            </div>

                                        @endforeach

                                    @else

                                        <div class="input-group mb-2">

                                            <input
                                                type="text"
                                                name="additional_videos_links[]"
                                                class="form-control"
                                                placeholder="Enter additional video link"
                                            >

                                            <div class="input-group-append">

                                                <button
                                                    class="btn btn-outline-secondary remove-link"
                                                    type="button"
                                                >
                                                    Remove
                                                </button>

                                            </div>

                                        </div>

                                    @endif

                                </div>


                                <button
                                    type="button"
                                    id="add-video-link"
                                    class="btn btn-primary"
                                >
                                    Add Another Link
                                </button>

                            </div>


                            {{-- =====================================================
                            | IMAGE
                            ====================================================== --}}

                            <div class="row">


                                {{-- Main Image --}}

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


                                    @if(!empty($service->image))

                                        <div
                                            class="current-main-image mt-3"
                                        >

                                            <img
                                                class="img-thumbnail"
                                                src="{{ asset('uploads/services/thumb/small/'.$service->image) }}"
                                                width="300"
                                            >

                                            <br>

                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm mt-2 remove-image"
                                                data-image="{{ $service->image }}"
                                            >
                                                Remove
                                            </button>

                                        </div>

                                    @endif

                                </div>


                                {{-- Gallery --}}

                                <div class="col-md-6">

                                    <label>
                                        Image Gallery
                                    </label>


                                    <div
                                        id="gallery"
                                        class="dropzone dz-clickable"
                                    >

                                        <div class="dz-message needsclick">

                                            <br>

                                            Drop files here or click to upload.

                                            <br><br>

                                        </div>

                                    </div>


                                    <input
                                        type="hidden"
                                        name="gallery_images"
                                        id="gallery_images"
                                        value=""
                                    >


                                    <p class="error gallery_images-error"></p>


                                    <div
                                        id="gallery-preview"
                                        class="row mt-3"
                                    >

                                        @php

                                            $galleryImages = [];

                                            if (is_array($service->gallery_images)) {

                                                $galleryImages =
                                                    $service->gallery_images;

                                            } elseif (!empty($service->gallery_images)) {

                                                $galleryImages =
                                                    json_decode(
                                                        $service->gallery_images,
                                                        true
                                                    ) ?: [];

                                            }

                                        @endphp


                                        @foreach(
                                            $galleryImages
                                            as $galleryImage
                                        )

                                            <div
                                                class="col-md-4 gallery-item mb-3"
                                            >

                                                <img
                                                    class="img-thumbnail"
                                                    src="{{ asset('uploads/services/gallery/'.$galleryImage) }}"
                                                    width="150"
                                                >


                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm mt-1 remove-gallery-image"
                                                    data-image="{{ $galleryImage }}"
                                                >
                                                    Remove
                                                </button>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            </div>


                            {{-- Image Alt Text --}}

                            <div class="form-group mt-3">

                                <label for="image_alt_text">
                                    Image Alt Text
                                </label>

                                <textarea
                                    name="image_alt_text"
                                    id="image_alt_text"
                                    rows="4"
                                    class="form-control"
                                    placeholder="MAX 160 CHARACTERS"
                                >{{ old('image_alt_text', $service->image_alt_text) }}</textarea>

                                <p class="error image_alt_text-error"></p>

                            </div>


                            {{-- Status --}}

                            <div class="form-group mt-4">

                                <label for="status">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control"
                                >

                                    <option
                                        value="1"
                                        {{ $service->status == 1 ? 'selected' : '' }}
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="0"
                                        {{ $service->status == 0 ? 'selected' : '' }}
                                    >
                                        Block
                                    </option>

                                </select>

                                <p class="error status-error"></p>

                            </div>


                            {{-- Submit --}}

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
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

<script>

Dropzone.autoDiscover = false;


/*
|--------------------------------------------------------------------------
| Gallery IDs
|--------------------------------------------------------------------------
*/

let uploadedGalleryIds = [];


/*
|--------------------------------------------------------------------------
| CSRF
|--------------------------------------------------------------------------
*/

const csrfToken =
    $('meta[name="csrf-token"]').attr('content')
    ||
    $('meta[name="_token"]').attr('content');


/*
|--------------------------------------------------------------------------
| MAIN IMAGE DROPZONE
|--------------------------------------------------------------------------
*/

const imageDropzone = $('#image').dropzone({

    url: "{{ route('tempUpload') }}",

    maxFiles: 1,

    addRemoveLinks: true,

    acceptedFiles:
        "image/jpeg,image/png,image/gif,image/webp,image/avif",

    headers: {
        'X-CSRF-TOKEN': csrfToken
    },

    success: function(file, response) {

        if (response.status === 200) {

            file.tempId = response.id;

            $('#image_id').val(
                response.id
            );

        }

    }

});


/*
|--------------------------------------------------------------------------
| GALLERY DROPZONE
|--------------------------------------------------------------------------
*/

const galleryDropzone = $('#gallery').dropzone({

    url: "{{ route('uploadGalleryImage') }}",

    maxFiles: null,

    addRemoveLinks: true,

    acceptedFiles:
        "image/jpeg,image/png,image/gif,image/webp,image/avif",

    headers: {
        'X-CSRF-TOKEN': csrfToken
    },

    success: function(file, response) {

        if (response.status === 200) {

            file.tempId = response.id;

            uploadedGalleryIds.push(
                response.id
            );

            $('#gallery_images').val(
                uploadedGalleryIds.join(',')
            );

        }

    },

    removedfile: function(file) {

        if (file.previewElement) {

            file.previewElement.remove();

        }


        if (file.tempId) {

            uploadedGalleryIds =
                uploadedGalleryIds.filter(
                    id =>
                        String(id) !==
                        String(file.tempId)
                );


            $('#gallery_images').val(
                uploadedGalleryIds.join(',')
            );

        }

    }

});


/*
|--------------------------------------------------------------------------
| REMEMBER SELECTED LANGUAGE
|--------------------------------------------------------------------------
*/

$(document).ready(function() {

    let language =
        localStorage.getItem(
            'service_edit_language'
        );


    if (!language) {

        language = 'en';

        localStorage.setItem(
            'service_edit_language',
            'en'
        );

    }


    if (language === 'ar') {

        $('#arabic-tab').tab('show');

    } else {

        $('#english-tab').tab('show');

    }


    $('a[data-toggle="tab"]').on(
        'shown.bs.tab',
        function(e) {

            const target =
                $(e.target).attr('href');


            if (target === '#arabic') {

                localStorage.setItem(
                    'service_edit_language',
                    'ar'
                );

            } else {

                localStorage.setItem(
                    'service_edit_language',
                    'en'
                );

            }

        }
    );

});


/*
|--------------------------------------------------------------------------
| ENGLISH CATEGORY CHANGE
|--------------------------------------------------------------------------
*/

$('#category').on('change', function() {

    const categoryId =
        $(this).val();


    /*
    |--------------------------------------------------------------------------
    | Sync Arabic category
    |--------------------------------------------------------------------------
    */

    $('#category_ar').val(
        categoryId
    );


    loadSubCategories(
        categoryId,
        '#sub_category',
        false
    );

});


/*
|--------------------------------------------------------------------------
| ARABIC CATEGORY CHANGE
|--------------------------------------------------------------------------
*/

$('#category_ar').on('change', function() {

    const categoryId =
        $(this).val();


    /*
    |--------------------------------------------------------------------------
    | Sync English category
    |--------------------------------------------------------------------------
    */

    $('#category').val(
        categoryId
    );


    loadSubCategories(
        categoryId,
        '#sub_category_ar',
        true
    );

});


/*
|--------------------------------------------------------------------------
| LOAD SUB CATEGORIES
|--------------------------------------------------------------------------
*/

function loadSubCategories(
    categoryId,
    target,
    arabic = false
) {

    const subCategory =
        $(target);


    subCategory.html(
        '<option value="">' +
        (
            arabic
                ? 'اختر الفئة الفرعية'
                : 'Select a sub-category'
        ) +
        '</option>'
    );


    if (!categoryId) {

        if (target === '#sub_category') {

            $('#sub_category_ar').html(
                '<option value="">اختر الفئة الفرعية</option>'
            );

        } else {

            $('#sub_category').html(
                '<option value="">Select a sub-category</option>'
            );

        }

        return;

    }


    $.ajax({

        url:
            "{{ route('service.subcategories') }}",

        type: 'GET',

        data: {
            category_id: categoryId
        },

        dataType: 'json',


        success: function(response) {

            if (
                response.status &&
                response.subCategories
            ) {


                /*
                |--------------------------------------------------------------------------
                | Current select
                |--------------------------------------------------------------------------
                */

                $.each(
                    response.subCategories,
                    function(index, item) {

                        const text =
                            arabic
                                ? (
                                    item.name_ar ||
                                    item.name
                                )
                                : item.name;


                        subCategory.append(
                            $('<option>', {
                                value: item.id,
                                text: text
                            })
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Other language select
                |--------------------------------------------------------------------------
                */

                const otherTarget =
                    target === '#sub_category'
                        ? '#sub_category_ar'
                        : '#sub_category';


                const other =
                    $(otherTarget);


                other.html(
                    '<option value="">' +
                    (
                        otherTarget ===
                        '#sub_category_ar'
                            ? 'اختر الفئة الفرعية'
                            : 'Select a sub-category'
                    ) +
                    '</option>'
                );


                $.each(
                    response.subCategories,
                    function(index, item) {

                        const text =
                            otherTarget ===
                            '#sub_category_ar'
                                ? (
                                    item.name_ar ||
                                    item.name
                                )
                                : item.name;


                        other.append(
                            $('<option>', {
                                value: item.id,
                                text: text
                            })
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Select existing service sub-category
                |--------------------------------------------------------------------------
                */

                const currentSubCategory =
                    "{{ $service->sub_category_id }}";


                if (currentSubCategory) {

                    subCategory.val(
                        currentSubCategory
                    );

                    other.val(
                        currentSubCategory
                    );

                }

            }

        }

    });

}


/*
|--------------------------------------------------------------------------
| ENGLISH SUB CATEGORY SYNC
|--------------------------------------------------------------------------
*/

$('#sub_category').on('change', function() {

    $('#sub_category_ar').val(
        $(this).val()
    );

});


/*
|--------------------------------------------------------------------------
| ARABIC SUB CATEGORY SYNC
|--------------------------------------------------------------------------
*/

$('#sub_category_ar').on('change', function() {

    $('#sub_category').val(
        $(this).val()
    );

});


/*
|--------------------------------------------------------------------------
| LOAD INITIAL SUB CATEGORIES
|--------------------------------------------------------------------------
*/

$(document).ready(function() {

    const categoryId =
        $('#category').val();


    if (categoryId) {

        loadSubCategories(
            categoryId,
            '#sub_category',
            false
        );

    }

});


/*
|--------------------------------------------------------------------------
| SUBMIT FORM
|--------------------------------------------------------------------------
*/

$('#editServiceForm').on(
    'submit',
    function(event) {

        event.preventDefault();


        const form =
            $(this);


        const button =
            form.find(
                'button[type="submit"]'
            );


        button.prop(
            'disabled',
            true
        );


        clearErrors();


        $.ajax({

            url:
                form.attr('action'),

            type: 'POST',

            dataType: 'json',

            data:
                form.serialize(),


            success: function(response) {

                button.prop(
                    'disabled',
                    false
                );


                if (
                    response.status === 200
                ) {

                    window.location.href =
                        response.redirect
                        ||
                        "{{ route('serviceList') }}";

                    return;

                }


                if (response.errors) {

                    showErrors(
                        response.errors
                    );

                }

            },


            error: function(xhr) {

                button.prop(
                    'disabled',
                    false
                );


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


                console.log(
                    xhr.responseText
                );


                alert(
                    'An error occurred while updating the service.'
                );

            }

        });

    }
);


/*
|--------------------------------------------------------------------------
| SHOW VALIDATION ERRORS
|--------------------------------------------------------------------------
*/

function showErrors(errors)
{
    clearErrors();

    $.each(
        errors,
        function(field, messages) {

            /*
            |--------------------------------------------------------------------------
            | Show error message
            |--------------------------------------------------------------------------
            */

            $('.' + field + '-error')
                .html(messages[0]);


            /*
            |--------------------------------------------------------------------------
            | Add Bootstrap invalid class
            |--------------------------------------------------------------------------
            */

            $('[name="' + field + '"]')
                .addClass('is-invalid');


            /*
            |--------------------------------------------------------------------------
            | Summernote fields
            |--------------------------------------------------------------------------
            */

            if (
                field === 'description' ||
                field === 'description_ar'
            ) {

                $('[name="' + field + '"]')
                    .next('.note-editor')
                    .addClass('is-invalid');

            }


            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            if (field === 'category') {

                $('.category-error')
                    .html(messages[0]);

                $('.category_ar-error')
                    .html(messages[0]);

                $('#category')
                    .addClass('is-invalid');

                $('#category_ar')
                    .addClass('is-invalid');
            }


            /*
            |--------------------------------------------------------------------------
            | Category Arabic
            |--------------------------------------------------------------------------
            */

            if (field === 'category_ar') {

                $('.category-error')
                    .html(messages[0]);

                $('.category_ar-error')
                    .html(messages[0]);

                $('#category')
                    .addClass('is-invalid');

                $('#category_ar')
                    .addClass('is-invalid');
            }


            /*
            |--------------------------------------------------------------------------
            | Sub Category
            |--------------------------------------------------------------------------
            */

            if (field === 'sub_category') {

                $('.sub_category-error')
                    .html(messages[0]);

                $('.sub_category_ar-error')
                    .html(messages[0]);

                $('#sub_category')
                    .addClass('is-invalid');

                $('#sub_category_ar')
                    .addClass('is-invalid');
            }


            /*
            |--------------------------------------------------------------------------
            | Sub Category Arabic
            |--------------------------------------------------------------------------
            */

            if (field === 'sub_category_ar') {

                $('.sub_category-error')
                    .html(messages[0]);

                $('.sub_category_ar-error')
                    .html(messages[0]);

                $('#sub_category')
                    .addClass('is-invalid');

                $('#sub_category_ar')
                    .addClass('is-invalid');
            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Keep current language tab
    |--------------------------------------------------------------------------
    */

    const language =
        localStorage.getItem(
            'service_edit_language'
        );


    if (language === 'ar') {

        $('#arabic-tab').tab('show');

    } else {

        $('#english-tab').tab('show');

    }
}

/*
|--------------------------------------------------------------------------
| CLEAR ERRORS
|--------------------------------------------------------------------------
*/
function clearErrors()
{
    /*
    |--------------------------------------------------------------------------
    | Clear error messages
    |--------------------------------------------------------------------------
    */

    $('.error').html('');


    /*
    |--------------------------------------------------------------------------
    | Remove invalid state from normal fields
    |--------------------------------------------------------------------------
    */

    $('.form-control')
        .removeClass('is-invalid');


    /*
    |--------------------------------------------------------------------------
    | Remove invalid state from Summernote
    |--------------------------------------------------------------------------
    */

    $('.note-editor')
        .removeClass('is-invalid');
}




/*
|--------------------------------------------------------------------------
| REMOVE MAIN IMAGE
|--------------------------------------------------------------------------
*/

$('.remove-image').on(
    'click',
    function() {

        const button =
            $(this);


        const imageName =
            button.data('image');


        $.ajax({

            url:
                "{{ route('service.remove.image', $service->id) }}",

            type: 'POST',

            data: {

                image: imageName,

                _token: csrfToken

            },


            success: function(response) {

                if (
                    response.status === 200
                ) {

                    button
                        .closest(
                            '.current-main-image'
                        )
                        .remove();


                    $('#image_id').val('');

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
                    'Unable to remove the image.'
                );

            }

        });

    }
);


/*
|--------------------------------------------------------------------------
| REMOVE GALLERY IMAGE
|--------------------------------------------------------------------------
*/

$('.remove-gallery-image').on(
    'click',
    function() {

        const button =
            $(this);


        const imageName =
            button.data('image');


        $.ajax({

            url:
                "{{ route('service.remove.gallery.image', $service->id) }}",

            type: 'POST',

            data: {

                image: imageName,

                _token: csrfToken

            },


            success: function(response) {

                if (
                    response.status === 200
                ) {

                    button
                        .closest(
                            '.gallery-item'
                        )
                        .remove();

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
                    'Unable to remove gallery image.'
                );

            }

        });

    }
);


/*
|--------------------------------------------------------------------------
| ADD VIDEO LINK
|--------------------------------------------------------------------------
*/

$('#add-video-link').on(
    'click',
    function() {

        $('#additional_videos_links').append(`

            <div class="input-group mb-2">

                <input
                    type="text"
                    name="additional_videos_links[]"
                    class="form-control"
                    placeholder="Enter additional video link"
                >

                <div class="input-group-append">

                    <button
                        class="btn btn-outline-secondary remove-link"
                        type="button"
                    >
                        Remove
                    </button>

                </div>

            </div>

        `);

    }
);


/*
|--------------------------------------------------------------------------
| REMOVE VIDEO LINK
|--------------------------------------------------------------------------
*/

$(document).on(
    'click',
    '.remove-link',
    function() {

        $(this)
            .closest('.input-group')
            .remove();

    }
);


/*
|--------------------------------------------------------------------------
| GENERATE SLUG
|--------------------------------------------------------------------------
*/

$('#name').on(
    'change keyup',
    function() {

        const name =
            $(this).val();


        if (!name) {

            $('#slug').val('');

            return;

        }


        $('button[type="submit"]')
            .prop(
                'disabled',
                true
            );


        $.ajax({

            url:
                "{{ route('service.slug') }}",

            type: 'GET',

            data: {

                name: name

            },

            dataType: 'json',


            success: function(response) {

                $('#slug').val(
                    response.slug
                );

            },


            complete: function() {

                $('button[type="submit"]')
                    .prop(
                        'disabled',
                        false
                    );

            }

        });

    }
);

</script>

@endsection
