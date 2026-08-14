@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Services / Edit</h1>
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

                <form
                    action="{{ route('service.edit.update', $service->id) }}"
                    method="POST"
                    id="editServiceForm"
                >

                    @csrf

                    <div class="card">

                        <div class="card-header">

                            <a
                                href="{{ route('serviceList') }}"
                                class="btn btn-primary"
                            >
                                Back
                            </a>

                        </div>

                        <div class="card-body">

                            <div class="form-group">

                                <label for="name">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    value="{{ $service->name }}"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                >

                                <p class="error name-error"></p>

                            </div>

                            <div class="form-group">

                                <label for="slug">
                                    Slug
                                </label>

                                <input
                                    type="text"
                                    readonly
                                    name="slug"
                                    id="slug"
                                    value="{{ $service->slug }}"
                                    class="form-control"
                                >

                                <p class="error slug-error"></p>

                            </div>

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

                            <div class="form-group">

                                <label for="videos_link">
                                    Video Link
                                </label>

                                <input
                                    type="text"
                                    value="{{ $service->videos_link }}"
                                    name="videos_link"
                                    id="videos_link"
                                    class="form-control"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Additional Videos Links
                                </label>

                                <div id="additional_videos_links">

                                    @if(is_array($additional_videos_links) && count($additional_videos_links))

                                        @foreach($additional_videos_links as $link)

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

                            <div class="form-group">

                                <label for="description">
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    id="description"
                                    class="summernote"
                                >{{ $service->description }}</textarea>

                            </div>

                            <div class="form-group">

                                <label for="short_description">
                                    Short Description
                                </label>

                                <textarea
                                    name="short_description"
                                    id="short_description"
                                    rows="7"
                                    class="form-control"
                                >{{ $service->short_desc }}</textarea>

                            </div>

                            <div class="form-group">

                                <label for="meta_title">
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    value="{{ $service->meta_title }}"
                                    name="meta_title"
                                    id="meta_title"
                                    class="form-control"
                                    placeholder="MAX 70 CHARACTERS"
                                >

                            </div>

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
                                >{{ $service->meta_description }}</textarea>

                            </div>

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
                                >{{ $service->meta_keywords }}</textarea>

                            </div>

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

                                    <div
                                        id="gallery-preview"
                                        class="row mt-3"
                                    >

                                        @if(!empty($service->gallery_images))

                                            @foreach(json_decode($service->gallery_images, true) ?: [] as $galleryImage)

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

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="image_alt_text">
                                    Image Alt Text
                                </label>

                                <textarea
                                    name="image_alt_text"
                                    id="image_alt_text"
                                    rows="4"
                                    class="form-control"
                                    placeholder="MAX 160 CHARACTERS"
                                >{{ $service->image_alt_text }}</textarea>

                            </div>

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

                            </div>

                            <button
                                type="submit"
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

<script>
Dropzone.autoDiscover = false;

let uploadedGalleryIds = [];

const csrfToken = $('meta[name="csrf-token"]').attr('content')
    || $('meta[name="_token"]').attr('content');

const imageDropzone = $('#image').dropzone({

    url: "{{ route('tempUpload') }}",

    maxFiles: 1,

    addRemoveLinks: true,

    acceptedFiles: "image/jpeg,image/png,image/gif,image/webp,image/avif",

    headers: {
        'X-CSRF-TOKEN': csrfToken
    },

    success: function(file, response) {

        if (response.status === 200) {
            file.tempId = response.id;
            $('#image_id').val(response.id);
        }

    }

});

const galleryDropzone = $('#gallery').dropzone({

    url: "{{ route('uploadGalleryImage') }}",

    maxFiles: null,

    addRemoveLinks: true,

    acceptedFiles: "image/jpeg,image/png,image/gif,image/webp,image/avif",

    headers: {
        'X-CSRF-TOKEN': csrfToken
    },

    success: function(file, response) {

        if (response.status === 200) {

            file.tempId = response.id;

            uploadedGalleryIds.push(response.id);

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
                    id => String(id) !== String(file.tempId)
                );

            $('#gallery_images').val(
                uploadedGalleryIds.join(',')
            );

        }

    }

});

$('#category').on('change', function() {

    const categoryId = $(this).val();

    $('#sub_category').html(
        '<option value="">Select a sub-category</option>'
    );

    if (!categoryId) {
        return;
    }

    $.ajax({

        url: "{{ route('service.subcategories') }}",

        type: "GET",

        data: {
            category_id: categoryId
        },

        dataType: "json",

        success: function(response) {

            if (
                response.status &&
                response.subCategories
            ) {

                $.each(
                    response.subCategories,
                    function(index, item) {

                        $('#sub_category').append(
                            $('<option>', {
                                value: item.id,
                                text: item.name
                            })
                        );

                    }
                );

            }

        }

    });

});

$('#editServiceForm').on('submit', function(event) {

    event.preventDefault();

    const form = $(this);

    const button = form.find(
        'button[type="submit"]'
    );

    button.prop('disabled', true);

    $('.error').html('');

    $.ajax({

        url: form.attr('action'),

        type: 'POST',

        dataType: 'json',

        data: form.serialize(),

        success: function(response) {

            button.prop('disabled', false);

            if (response.status === 200) {

                window.location.href =
                    response.redirect ||
                    "{{ route('serviceList') }}";

                return;
            }

            if (response.errors) {

                $.each(
                    response.errors,
                    function(field, messages) {

                        $('.' + field + '-error')
                            .html(messages[0]);

                    }
                );

            }

        },

        error: function(xhr) {

            button.prop('disabled', false);

            if (
                xhr.status === 422 &&
                xhr.responseJSON &&
                xhr.responseJSON.errors
            ) {

                $.each(
                    xhr.responseJSON.errors,
                    function(field, messages) {

                        $('.' + field + '-error')
                            .html(messages[0]);

                    }
                );

            } else {

                console.log(xhr.responseText);

                alert(
                    'An error occurred while updating the service.'
                );

            }

        }

    });

});

$('.remove-image').on('click', function() {

    const button = $(this);

    const imageName = button.data('image');

    $.ajax({

        url: "{{ route('service.remove.image', $service->id) }}",

        type: 'POST',

        data: {
            image: imageName,
            _token: csrfToken
        },

        success: function(response) {

            if (response.status === 200) {

                button
                    .closest('.current-main-image')
                    .remove();

                $('#image_id').val('');

            } else {

                alert(response.message);

            }

        },

        error: function(xhr) {

            console.log(xhr.responseText);

            alert(
                'Unable to remove the image.'
            );

        }

    });

});

$('.remove-gallery-image').on('click', function() {

    const button = $(this);

    const imageName = button.data('image');

    $.ajax({

        url: "{{ route('service.remove.gallery.image', $service->id) }}",

        type: 'POST',

        data: {
            image: imageName,
            _token: csrfToken
        },

        success: function(response) {

            if (response.status === 200) {

                button
                    .closest('.gallery-item')
                    .remove();

            } else {

                alert(response.message);

            }

        },

        error: function(xhr) {

            console.log(xhr.responseText);

            alert(
                'Unable to remove gallery image.'
            );

        }

    });

});

$('#add-video-link').on('click', function() {

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

});

$(document).on(
    'click',
    '.remove-link',
    function() {

        $(this)
            .closest('.input-group')
            .remove();

    }
);

$('#name').on('change keyup', function() {

    const name = $(this).val();

    if (!name) {

        $('#slug').val('');

        return;
    }

    $('button[type="submit"]').prop(
        'disabled',
        true
    );

    $.ajax({

        url: "{{ route('service.slug') }}",

        type: 'GET',

        data: {
            name: name
        },

        dataType: 'json',

        success: function(response) {

            $('#slug').val(response.slug);

        },

        complete: function() {

            $('button[type="submit"]').prop(
                'disabled',
                false
            );

        }

    });

});
</script>

@endsection
