@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content h-100">
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-12">

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form
                    action=""
                    method="post"
                    name="settingsFrom"
                    id="settingsFrom">

                    @csrf

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label>Website Title</label>
                                <input
                                    type="text"
                                    name="website_title"
                                    class="form-control"
                                    value="{{ $settings->website_title ?? '' }}">
                                <p class="error website-title-error text-danger"></p>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input
                                    type="text"
                                    name="email"
                                    class="form-control"
                                    value="{{ $settings->email ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ $settings->phone ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Copyright</label>
                                <input
                                    type="text"
                                    name="copy"
                                    class="form-control"
                                    value="{{ $settings->copy ?? '' }}">
                            </div>

                            <div class="mt-4">
                                <h4><strong>Social Links</strong></h4>
                                <hr>

                                <div class="form-group">
                                    <label>Facebook Url</label>
                                    <input
                                        type="text"
                                        name="facebook_url"
                                        class="form-control"
                                        value="{{ $settings->facebook_url ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Twitter Url</label>
                                    <input
                                        type="text"
                                        name="twitter_url"
                                        class="form-control"
                                        value="{{ $settings->twitter_url ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Instagram Url</label>
                                    <input
                                        type="text"
                                        name="instagram_url"
                                        class="form-control"
                                        value="{{ $settings->instagram_url ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Whatsapp Url</label>
                                    <input
                                        type="text"
                                        name="whatsapp_url"
                                        class="form-control"
                                        value="{{ $settings->whatsapp_url ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Tiktok Url</label>
                                    <input
                                        type="text"
                                        name="tiktok_url"
                                        class="form-control"
                                        value="{{ $settings->tiktok_url ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Linkedin Url</label>
                                    <input
                                        type="text"
                                        name="linkedin_url"
                                        class="form-control"
                                        value="{{ $settings->linkedin_url ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Youtube Url</label>
                                    <input
                                        type="text"
                                        name="youtube_url"
                                        class="form-control"
                                        value="{{ $settings->youtube_url ?? '' }}">
                                </div>
                            </div>

                            <div class="row mt-4">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Card One</label>
                                        <textarea
                                            name="contact_card_one"
                                            class="summernote">{!! $settings->contact_card_one ?? '' !!}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <label><strong>Featured Categories</strong></label>

                                    <div class="input-group mb-2">
                                        <select
                                            id="featured_category"
                                            class="form-control">

                                            <option value="">
                                                Select Category
                                            </option>

                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <div class="input-group-append">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                onclick="addCategory()">
                                                Add
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        id="featured-categories-wrapper"
                                        class="featured-wrapper">

                                        @foreach($featuredCategories as $featured)

                                            @php
                                                $category = $categories->firstWhere('id', $featured->category_id);
                                            @endphp

                                            @if($category)
                                                <div
                                                    class="featured-item ui-state-default"
                                                    data-id="{{ $category->id }}">

                                                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

                                                    <span>
                                                        {{ $category->name }}
                                                    </span>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm float-right"
                                                        onclick="deleteCategory({{ $category->id }})">
                                                        Delete
                                                    </button>

                                                </div>
                                            @endif

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Card Two</label>
                                        <textarea
                                            name="contact_card_two"
                                            class="summernote">{!! $settings->contact_card_two ?? '' !!}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <label><strong>Featured Sub Categories</strong></label>

                                    <div class="input-group mb-2">
                                        <select
                                            id="featured_sub_category"
                                            class="form-control">

                                            <option value="">
                                                Select Sub Category
                                            </option>

                                            @foreach($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">
                                                    {{ $sub_category->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <div class="input-group-append">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                onclick="addSubCategory()">
                                                Add
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        id="featured-sub-categories-wrapper"
                                        class="featured-wrapper">

                                        @foreach($featuredSubCategories as $featured)

                                            @php
                                                $subCategory = $sub_categories->firstWhere('id', $featured->sub_category_id);
                                            @endphp

                                            @if($subCategory)
                                                <div
                                                    class="featured-item ui-state-default"
                                                    data-id="{{ $subCategory->id }}">

                                                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

                                                    <span>
                                                        {{ $subCategory->name }}
                                                    </span>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm float-right"
                                                        onclick="deleteSubCategory({{ $subCategory->id }})">
                                                        Delete
                                                    </button>

                                                </div>
                                            @endif

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                            <div class="mt-4">
                                <button
                                    type="submit"
                                    id="settingsSubmit"
                                    class="btn btn-primary">
                                    Submit
                                </button>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

@endsection

@section('extraCss')

<style>
    .featured-wrapper {
        min-height: 10px;
    }

    .featured-item {
        padding: 10px;
        margin-bottom: 5px;
        border: 1px solid #ddd;
        background: #f8f9fa;
        cursor: move;
        min-height: 45px;
    }

    .featured-item .ui-icon {
        display: inline-block;
        vertical-align: middle;
        margin-right: 5px;
    }

    .ui-state-highlight {
        height: 45px;
        margin-bottom: 5px;
        border: 1px dashed #999;
        background: #eee;
    }
</style>

@endsection

@section('extraJs')

<script>

$(function() {
    $("#featured-categories-wrapper").sortable({
        placeholder: "ui-state-highlight"
    });

    $("#featured-sub-categories-wrapper").sortable({
        placeholder: "ui-state-highlight"
    });
});

function addCategory() {
    let id = $("#featured_category").val();
    let name = $("#featured_category option:selected").text().trim();

    if (!id) {
        alert("Please select a category.");
        return;
    }

    if ($("#featured-category-" + id).length) {
        alert("This category is already added.");
        return;
    }

    $("#featured-categories-wrapper").append(`
        <div
            id="featured-category-${id}"
            class="featured-item ui-state-default"
            data-id="${id}">

            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

            <span>${name}</span>

            <button
                type="button"
                class="btn btn-danger btn-sm float-right"
                onclick="deleteCategory(${id})">

                Delete

            </button>
        </div>
    `);

    $("#featured_category").val("");
}

function deleteCategory(id) {
    $("#featured-category-" + id).remove();
}

function addSubCategory() {
    let id = $("#featured_sub_category").val();
    let name = $("#featured_sub_category option:selected").text().trim();

    if (!id) {
        alert("Please select a sub category.");
        return;
    }

    if ($("#featured-sub-category-" + id).length) {
        alert("This sub category is already added.");
        return;
    }

    $("#featured-sub-categories-wrapper").append(`
        <div
            id="featured-sub-category-${id}"
            class="featured-item ui-state-default"
            data-id="${id}">

            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

            <span>${name}</span>

            <button
                type="button"
                class="btn btn-danger btn-sm float-right"
                onclick="deleteSubCategory(${id})">

                Delete

            </button>
        </div>
    `);

    $("#featured_sub_category").val("");
}

function deleteSubCategory(id) {
    $("#featured-sub-category-" + id).remove();
}

$("#settingsFrom").submit(function(event) {
    event.preventDefault();

    $("#settingsSubmit").prop("disabled", true);

    let categories = [];

    $("#featured-categories-wrapper .featured-item").each(function() {
        categories.push($(this).data("id"));
    });

    let subCategories = [];

    $("#featured-sub-categories-wrapper .featured-item").each(function() {
        subCategories.push($(this).data("id"));
    });

    let data = $("#settingsFrom").serializeArray();

    data.push({
        name: "featured_categories",
        value: JSON.stringify(categories)
    });

    data.push({
        name: "featured_sub_categories",
        value: JSON.stringify(subCategories)
    });

    $.ajax({
        url: '{{ route("settings.save") }}',
        type: "POST",
        dataType: "json",
        data: data,

        success: function(response) {
            $("#settingsSubmit").prop("disabled", false);

            if (response.status == 200) {
                window.location.href = '{{ route("settings.index") }}';
            } else {
                if (response.errors && response.errors.website_title) {
                    $(".website-title-error").html(
                        response.errors.website_title[0]
                    );
                }
            }
        },

        error: function(xhr) {
            $("#settingsSubmit").prop("disabled", false);
            console.log(xhr.responseText);
            alert("Something went wrong. Please try again.");
        }
    });
});

</script>

@endsection
