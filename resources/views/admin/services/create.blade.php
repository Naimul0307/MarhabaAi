@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Services / Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
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

                <form action="{{ route('service.create') }}" method="post" id="createServiceForm">
                    @csrf

                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('serviceList') }}" class="btn btn-primary">
                                Back
                            </a>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <p class="error name-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control">
                                <p class="error slug-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a category</option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="error category-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="sub_category">Sub-Category</label>

                                <select name="sub_category" id="sub_category" class="form-control">
                                    <option value="">Select a sub-category</option>

                                    @foreach($sub_categories as $sub_category)
                                        <option
                                            value="{{ $sub_category->id }}"
                                            data-category="{{ $sub_category->category_id }}"
                                        >
                                            {{ $sub_category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="error sub_category-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="summernote"
                                ></textarea>
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
                                ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="videos_link">Video Link</label>
                                <input type="text" name="videos_link" id="videos_link" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="additional_videos_links">
                                    Additional Videos Links
                                </label>

                                <div id="additional_videos_links">
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
                                <label for="meta_title">Meta Title</label>

                                <input
                                    type="text"
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
                                ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>

                                <textarea
                                    name="meta_keywords"
                                    id="meta_keywords"
                                    rows="7"
                                    class="form-control"
                                    placeholder="MAX 160 CHARACTERS"
                                ></textarea>
                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <input
                                        type="hidden"
                                        name="image_id"
                                        id="image_id"
                                        value=""
                                    >

                                    <label for="image">Image</label>

                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>
                                            Drop files here or click to upload.
                                            <br><br>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label for="gallery">Image Gallery</label>

                                    <div id="gallery" class="dropzone dz-clickable">
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
                                ></textarea>
                            </div>

                            <div class="form-group mt-4">
                                <label for="status">Status</label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control"
                                >
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
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
            uploadedGalleryIds = uploadedGalleryIds.filter(
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

    const subCategory = $('#sub_category');

    subCategory.html(
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

            if (response.status && response.subCategories) {

                $.each(
                    response.subCategories,
                    function(index, item) {

                        subCategory.append(
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

$('#createServiceForm').on('submit', function(event) {

    event.preventDefault();

    const form = $(this);

    const submitButton = form.find('button[type="submit"]');

    submitButton.prop('disabled', true);

    $('.error').html('');

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: form.serialize(),

        success: function(response) {

            submitButton.prop('disabled', false);

            if (response.status === 200) {

                window.location.href =
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

            submitButton.prop('disabled', false);

            $('.error').html('');

            if (xhr.status === 422 && xhr.responseJSON) {

                if (xhr.responseJSON.errors) {

                    $.each(
                        xhr.responseJSON.errors,
                        function(field, messages) {

                            $('.' + field + '-error')
                                .html(messages[0]);

                        }
                    );
                }

                return;
            }

            console.log(xhr.responseText);

            alert(
                'An error occurred while saving the service.'
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
