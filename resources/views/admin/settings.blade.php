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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
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

                    <form action="" method="post" name="settingsFrom" id="settingsFrom">
                        @csrf
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="website_title">Website Title</label>
                                    <input type="text" name="website_title" id="website_title" class="form-control" value="{{ (!empty($settings->website_title)) ? $settings->website_title : '' }}">
                                    <p class="error website-title-error text-danger"></p>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ (!empty($settings->email)) ? $settings->email : '' }}" name="email" id="email" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" value="{{ (!empty($settings->phone)) ? $settings->phone : '' }}" name="phone" id="phone" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="copy">Copyright</label>
                                    <input type="text" value="{{ (!empty($settings->copy)) ? $settings->copy : '' }}" name="copy" id="copy" class="form-control">
                                </div>

                                <div class="mt-4">
                                    <h4><strong>Social Links</strong></h4>
                                    <hr>

                                    <div class="form-group">
                                        <label for="facebook_url">Facebook Url</label>
                                        <input type="text" value="{{ (!empty($settings->facebook_url)) ? $settings->facebook_url : '' }}" name="facebook_url" id="facebook_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="twitter_url">Twitter Url</label>
                                        <input type="text" value="{{ (!empty($settings->twitter_url)) ? $settings->twitter_url : '' }}" name="twitter_url" id="twitter_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="instagram_url">Instagram Url</label>
                                        <input type="text" value="{{ (!empty($settings->instagram_url)) ? $settings->instagram_url : '' }}" name="instagram_url" id="instagram_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp_url">Whatsapp Url</label>
                                        <input type="text" value="{{ (!empty($settings->whatsapp_url)) ? $settings->whatsapp_url : '' }}" name="whatsapp_url" id="whatsapp_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="tiktok_url">Tiktok Url</label>
                                        <input type="text" value="{{ (!empty($settings->tiktok_url)) ? $settings->tiktok_url : '' }}" name="tiktok_url" id="tiktok_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="linkedin_url">Linkedin Url</label>
                                        <input type="text" value="{{ (!empty($settings->linkedin_url)) ? $settings->linkedin_url : '' }}" name="linkedin_url" id="linkedin_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="youtube_url">Youtube Url</label>
                                        <input type="text" value="{{ (!empty($settings->youtube_url)) ? $settings->youtube_url : '' }}" name="youtube_url" id="youtube_url" class="form-control">
                                    </div>
                                     <div class="form-group">
                                        <label for="google_map">Googel Map Url</label>
                                        <input type="text" value="{{ (!empty($settings->google_map)) ? $settings->google_map : '' }}" name="google_map" id="google_map" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-4">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_card_one">Contact Card One</label>
                                            <textarea name="contact_card_one" id="contact_card_one" class="summernote">{!! (!empty($settings->contact_card_one)) ? $settings->contact_card_one : '' !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label><strong>Featured Categories</strong></label>

                                        <div class="input-group mb-2">
                                            <select id="featured_category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" onclick="addCategory()">Add</button>
                                            </div>
                                        </div>

                                        <div id="featured-categories-wrapper" class="featured-wrapper">
                                            @foreach($featuredCategories as $featured)
                                                @php
                                                    $category = $categories->firstWhere('id', $featured->category_id);
                                                @endphp
                                                @if($category)
                                                    <div class="featured-item ui-state-default" data-id="{{ $category->id }}" id="featured-category-{{ $category->id }}">
                                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                                        <span>{{ $category->name }}</span>
                                                        <button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteCategory({{ $category->id }})">Delete</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_card_two">Contact Card Two</label>
                                            <textarea name="contact_card_two" id="contact_card_two" class="summernote">{!! (!empty($settings->contact_card_two)) ? $settings->contact_card_two : '' !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label><strong>Featured Sub Categories</strong></label>

                                        <div class="input-group mb-2">
                                            <select id="featured_sub_category" class="form-control">
                                                <option value="">Select Sub Category</option>
                                                @foreach($sub_categories as $sub_category)
                                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" onclick="addSubCategory()">Add</button>
                                            </div>
                                        </div>

                                        <div id="featured-sub-categories-wrapper" class="featured-wrapper">
                                            @foreach($featuredSubCategories as $featured)
                                                @php
                                                    $subCategory = $sub_categories->firstWhere('id', $featured->sub_category_id);
                                                @endphp
                                                @if($subCategory)
                                                    <div class="featured-item ui-state-default" data-id="{{ $subCategory->id }}" id="featured-sub-category-{{ $subCategory->id }}">
                                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                                        <span>{{ $subCategory->name }}</span>
                                                        <button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteSubCategory({{ $subCategory->id }})">Delete</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <button type="submit" id="settingsSubmit" class="btn btn-primary">Submit</button>
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
<script type="text/javascript">

$(function() {
    $("#featured-categories-wrapper").sortable({ placeholder: "ui-state-highlight" });
    $("#featured-sub-categories-wrapper").sortable({ placeholder: "ui-state-highlight" });
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
        <div id="featured-category-${id}" class="featured-item ui-state-default" data-id="${id}">
            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
            <span>${name}</span>
            <button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteCategory(${id})">Delete</button>
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
        <div id="featured-sub-category-${id}" class="featured-item ui-state-default" data-id="${id}">
            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
            <span>${name}</span>
            <button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteSubCategory(${id})">Delete</button>
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
    data.push({ name: "featured_categories", value: JSON.stringify(categories) });
    data.push({ name: "featured_sub_categories", value: JSON.stringify(subCategories) });

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
                    $(".website-title-error").html(response.errors.website_title[0]);
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
