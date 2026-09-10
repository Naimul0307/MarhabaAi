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
                        <a href="{{ route('admin.dashboard') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Settings
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

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form
                    action="{{ route('settings.save') }}"
                    method="POST"
                    name="settingsFrom"
                    id="settingsFrom"
                >

                    @csrf

                    <div class="card">

                        <div class="card-body">

                            <div class="form-group">

                                <label for="website_title">
                                    Website Title
                                </label>

                                <input
                                    type="text"
                                    name="website_title"
                                    id="website_title"
                                    class="form-control"
                                    value="{{ old('website_title', $settings->website_title ?? '') }}"
                                >

                                <p class="error website-title-error text-danger"></p>

                            </div>

                            <div class="form-group">

                                <label for="email">
                                    Email
                                </label>

                                <input
                                    type="text"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="{{ old('email', $settings->email ?? '') }}"
                                >

                            </div>

                            <div class="form-group">

                                <label for="phone">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    value="{{ old('phone', $settings->phone ?? '') }}"
                                >

                            </div>

                            <div class="form-group">

                                <label for="google_map">
                                    Google Map Embed URL
                                </label>

                                <textarea
                                    name="google_map"
                                    id="google_map"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Paste Google Maps embed URL here"
                                >{{ old('google_map', $settings->google_map ?? '') }}</textarea>

                                <small class="text-muted">
                                    Paste the Google Maps iframe embed URL.
                                </small>

                            </div>

                            <div class="form-group">

                                <label for="copy">
                                    Copyright
                                </label>

                                <input
                                    type="text"
                                    name="copy"
                                    id="copy"
                                    class="form-control"
                                    value="{{ old('copy', $settings->copy ?? '') }}"
                                >

                            </div>

                            <div class="mt-4">

                                <h4>
                                    <strong>Social Links</strong>
                                </h4>

                                <hr>

                                <div class="form-group">

                                    <label for="facebook_url">
                                        Facebook Url
                                    </label>

                                    <input
                                        type="text"
                                        name="facebook_url"
                                        id="facebook_url"
                                        class="form-control"
                                        value="{{ old('facebook_url', $settings->facebook_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="twitter_url">
                                        Twitter Url
                                    </label>

                                    <input
                                        type="text"
                                        name="twitter_url"
                                        id="twitter_url"
                                        class="form-control"
                                        value="{{ old('twitter_url', $settings->twitter_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="instagram_url">
                                        Instagram Url
                                    </label>

                                    <input
                                        type="text"
                                        name="instagram_url"
                                        id="instagram_url"
                                        class="form-control"
                                        value="{{ old('instagram_url', $settings->instagram_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="whatsapp_url">
                                        Whatsapp Url
                                    </label>

                                    <input
                                        type="text"
                                        name="whatsapp_url"
                                        id="whatsapp_url"
                                        class="form-control"
                                        value="{{ old('whatsapp_url', $settings->whatsapp_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="tiktok_url">
                                        Tiktok Url
                                    </label>

                                    <input
                                        type="text"
                                        name="tiktok_url"
                                        id="tiktok_url"
                                        class="form-control"
                                        value="{{ old('tiktok_url', $settings->tiktok_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="linkedin_url">
                                        Linkedin Url
                                    </label>

                                    <input
                                        type="text"
                                        name="linkedin_url"
                                        id="linkedin_url"
                                        class="form-control"
                                        value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="youtube_url">
                                        Youtube Url
                                    </label>

                                    <input
                                        type="text"
                                        name="youtube_url"
                                        id="youtube_url"
                                        class="form-control"
                                        value="{{ old('youtube_url', $settings->youtube_url ?? '') }}"
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="google_map">
                                        Google Map Url
                                    </label>

                                    <input
                                        type="text"
                                        name="google_map"
                                        id="google_map"
                                        class="form-control"
                                        value="{{ old('google_map', $settings->google_map ?? '') }}"
                                    >

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="contact_card_one">
                                            Contact Card One
                                        </label>

                                        <textarea
                                            name="contact_card_one"
                                            id="contact_card_one"
                                            class="summernote"
                                        >{!! $settings->contact_card_one ?? '' !!}</textarea>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="featured-section">

                                        <label>
                                            <strong>
                                                Featured Categories
                                            </strong>
                                        </label>

                                        <div class="input-group mb-2">

                                            <select
                                                id="featured_category"
                                                class="form-control"
                                            >

                                                <option value="">
                                                    Select Category
                                                </option>

                                                @foreach($categories as $category)

                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                        —
                                                        {{ $category->name_ar }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <div class="input-group-append">

                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    id="addCategoryButton"
                                                >
                                                    Add
                                                </button>

                                            </div>

                                        </div>

                                        <div
                                            id="featured-categories-wrapper"
                                            class="featured-wrapper"
                                        >

                                            @foreach($featuredCategories as $featured)

                                                @if($featured->category)

                                                    <div
                                                        class="featured-item ui-state-default"
                                                        data-id="{{ $featured->category->id }}"
                                                        id="featured-category-{{ $featured->category->id }}"
                                                    >

                                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

                                                        <span class="featured-name">

                                                            <span>
                                                                {{ $featured->category->name }}
                                                            </span>

                                                            <span class="name-separator">
                                                                —
                                                            </span>

                                                            <span
                                                                class="arabic-name"
                                                                dir="rtl"
                                                            >
                                                                {{ $featured->category->name_ar }}
                                                            </span>

                                                        </span>

                                                        <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm delete-category"
                                                            data-id="{{ $featured->category->id }}"
                                                        >
                                                            Delete
                                                        </button>

                                                    </div>

                                                @endif

                                            @endforeach

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="contact_card_two">
                                            Contact Card Two
                                        </label>

                                        <textarea
                                            name="contact_card_two"
                                            id="contact_card_two"
                                            class="summernote"
                                        >{!! $settings->contact_card_two ?? '' !!}</textarea>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="featured-section">

                                        <label>
                                            <strong>
                                                Featured Sub Categories
                                            </strong>
                                        </label>

                                        <div class="input-group mb-2">

                                            <select
                                                id="featured_sub_category"
                                                class="form-control"
                                            >

                                                <option value="">
                                                    Select Sub Category
                                                </option>

                                                @foreach($sub_categories as $sub_category)

                                                    <option value="{{ $sub_category->id }}">
                                                        {{ $sub_category->name }}
                                                        —
                                                        {{ $sub_category->name_ar }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <div class="input-group-append">

                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    id="addSubCategoryButton"
                                                >
                                                    Add
                                                </button>

                                            </div>

                                        </div>

                                        <div
                                            id="featured-sub-categories-wrapper"
                                            class="featured-wrapper"
                                        >

                                            @foreach($featuredSubCategories as $featured)

                                                @if($featured->subCategory)

                                                    <div
                                                        class="featured-item ui-state-default"
                                                        data-id="{{ $featured->subCategory->id }}"
                                                        id="featured-sub-category-{{ $featured->subCategory->id }}"
                                                    >

                                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

                                                        <span class="featured-name">

                                                            <span>
                                                                {{ $featured->subCategory->name }}
                                                            </span>

                                                            <span class="name-separator">
                                                                —
                                                            </span>

                                                            <span
                                                                class="arabic-name"
                                                                dir="rtl"
                                                            >
                                                                {{ $featured->subCategory->name_ar }}
                                                            </span>

                                                        </span>

                                                        <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm delete-sub-category"
                                                            data-id="{{ $featured->subCategory->id }}"
                                                        >
                                                            Delete
                                                        </button>

                                                    </div>

                                                @endif

                                            @endforeach

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="mt-4">

                                <button
                                    type="submit"
                                    id="settingsSubmit"
                                    class="btn btn-primary"
                                >
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
    margin-top: 10px;
}

.featured-item {
    position: relative;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 110px 10px 12px;
    margin-bottom: 6px;
    min-height: 48px;
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: move;
}

.featured-item .ui-icon {
    flex: 0 0 auto;
}

.featured-name {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 5px;
    line-height: 1.5;
}

.arabic-name {
    direction: rtl;
    unicode-bidi: isolate;
}

.name-separator {
    color: #777;
}

.featured-item .btn {
    position: absolute;
    right: 8px;
    top: 8px;
}

.ui-state-highlight {
    height: 48px;
    margin-bottom: 6px;
    border: 1px dashed #999;
    background: #eee;
    border-radius: 4px;
}

</style>

@endsection

@section('extraJs')

<script>

$(document).ready(function () {

    $('#featured-categories-wrapper').sortable({
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true
    });

    $('#featured-sub-categories-wrapper').sortable({
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true
    });

    $('#addCategoryButton').on('click', function () {
        addCategory();
    });

    $('#addSubCategoryButton').on('click', function () {
        addSubCategory();
    });

    $(document).on('click', '.delete-category', function () {

        const id = $(this).data('id');

        $('#featured-category-' + id).remove();

    });

    $(document).on('click', '.delete-sub-category', function () {

        const id = $(this).data('id');

        $('#featured-sub-category-' + id).remove();

    });

    $('#settingsFrom').on('submit', function (event) {

        event.preventDefault();

        $('.website-title-error').html('');

        const submitButton = $('#settingsSubmit');

        submitButton.prop('disabled', true);

        const categories = [];

        $('#featured-categories-wrapper .featured-item').each(function () {

            categories.push(
                $(this).data('id')
            );

        });

        const subCategories = [];

        $('#featured-sub-categories-wrapper .featured-item').each(function () {

            subCategories.push(
                $(this).data('id')
            );

        });

        const data = $(this).serializeArray();

        data.push({
            name: 'featured_categories',
            value: JSON.stringify(categories)
        });

        data.push({
            name: 'featured_sub_categories',
            value: JSON.stringify(subCategories)
        });

        $.ajax({

            url: '{{ route("settings.save") }}',

            type: 'POST',

            dataType: 'json',

            data: data,

            success: function (response) {

                submitButton.prop('disabled', false);

                if (response.status === 200) {

                    window.location.href =
                        '{{ route("settings.index") }}';

                    return;
                }

                if (
                    response.errors &&
                    response.errors.website_title
                ) {

                    $('.website-title-error').html(
                        response.errors.website_title[0]
                    );

                }

            },

            error: function (xhr) {

                submitButton.prop('disabled', false);

                console.error(xhr.responseText);

                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {

                    alert(
                        xhr.responseJSON.message
                    );

                } else {

                    alert(
                        'Something went wrong. Please try again.'
                    );

                }

            }

        });

    });

});

function addCategory()
{
    const select = $('#featured_category');

    const id = select.val();

    const selectedOption = select.find('option:selected');

    const text = selectedOption.text().trim();

    if (!id) {

        alert('Please select a category.');

        return;
    }

    if ($('#featured-category-' + id).length) {

        alert('This category is already added.');

        return;
    }

    const parts = text.split('—');

    const englishName = parts[0]
        ? parts[0].trim()
        : '';

    const arabicName = parts[1]
        ? parts.slice(1).join('—').trim()
        : '';

    const item = `
        <div
            id="featured-category-${id}"
            class="featured-item ui-state-default"
            data-id="${id}"
        >

            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

            <span class="featured-name">

                <span>
                    ${escapeHtml(englishName)}
                </span>

                <span class="name-separator">
                    —
                </span>

                <span
                    class="arabic-name"
                    dir="rtl"
                >
                    ${escapeHtml(arabicName)}
                </span>

            </span>

            <button
                type="button"
                class="btn btn-danger btn-sm delete-category"
                data-id="${id}"
            >
                Delete
            </button>

        </div>
    `;

    $('#featured-categories-wrapper').append(item);

    select.val('');
}

function addSubCategory()
{
    const select = $('#featured_sub_category');

    const id = select.val();

    const selectedOption = select.find('option:selected');

    const text = selectedOption.text().trim();

    if (!id) {

        alert('Please select a sub category.');

        return;
    }

    if ($('#featured-sub-category-' + id).length) {

        alert('This sub category is already added.');

        return;
    }

    const parts = text.split('—');

    const englishName = parts[0]
        ? parts[0].trim()
        : '';

    const arabicName = parts[1]
        ? parts.slice(1).join('—').trim()
        : '';

    const item = `
        <div
            id="featured-sub-category-${id}"
            class="featured-item ui-state-default"
            data-id="${id}"
        >

            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>

            <span class="featured-name">

                <span>
                    ${escapeHtml(englishName)}
                </span>

                <span class="name-separator">
                    —
                </span>

                <span
                    class="arabic-name"
                    dir="rtl"
                >
                    ${escapeHtml(arabicName)}
                </span>

            </span>

            <button
                type="button"
                class="btn btn-danger btn-sm delete-sub-category"
                data-id="${id}"
            >
                Delete
            </button>

        </div>
    `;

    $('#featured-sub-categories-wrapper').append(item);

    select.val('');
}

function escapeHtml(value)
{
    return $('<div>')
        .text(value)
        .html();
}

</script>

@endsection
