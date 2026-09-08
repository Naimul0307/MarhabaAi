@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">SUB CATEGORY / Edit</h1>
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

                <form
                    action=""
                    method="post"
                    name="editSubCategoryForm"
                    id="editSubCategoryForm">

                    @csrf

                    <div class="card">

                        <div class="card-header">
                            <a
                                href="{{ route('subCategoryList') }}"
                                class="btn btn-primary">
                                Back
                            </a>
                        </div>

                        <div class="card-body">

                            {{-- LANGUAGE TABS --}}
                            <ul class="nav nav-tabs" role="tablist">

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

                                {{-- ENGLISH --}}
                                <div
                                    class="tab-pane fade"
                                    id="english"
                                    role="tabpanel">

                                    {{-- CATEGORY --}}
                                    <div class="form-group">
                                        <label for="category_id">
                                            Category
                                        </label>

                                        <select
                                            name="category_id"
                                            id="category_id"
                                            class="form-control">

                                            <option value="">
                                                Select a category
                                            </option>

                                            @foreach($categories as $category)
                                                <option
                                                    value="{{ $category->id }}"
                                                    {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <p class="error category_id-error"></p>
                                    </div>

                                    {{-- NAME --}}
                                    <div class="form-group">
                                        <label for="name">
                                            Name
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ old('name', $subCategory->name) }}"
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
                                        value="{{ $subCategory->slug }}"
                                        class="form-control is-invalid">

                                    <p class="error slug-error"></p>
                                </div>
                                    {{-- DESCRIPTION --}}
                                    <div class="form-group">
                                        <label for="description">
                                            Description
                                        </label>

                                        <textarea
                                            name="description"
                                            id="description"
                                            rows="7"
                                            class="form-control is-invalid"
                                            placeholder="MAX 160 CHARACTERS">{{ old('description', $subCategory->description) }}</textarea>
                                    </div>

                                    {{-- META TITLE --}}
                                    <div class="form-group">
                                        <label for="meta_title">
                                            Meta Title
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ old('meta_title', $subCategory->meta_title) }}"
                                            name="meta_title"
                                            id="meta_title"
                                            class="form-control is-invalid"
                                            placeholder="MAX 70 CHARACTERS">
                                    </div>

                                    {{-- META DESCRIPTION --}}
                                    <div class="form-group">
                                        <label for="meta_description">
                                            Meta Description
                                        </label>

                                        <textarea
                                            name="meta_description"
                                            id="meta_description"
                                            rows="7"
                                            class="form-control is-invalid"
                                            placeholder="MAX 160 CHARACTERS">{{ old('meta_description', $subCategory->meta_description) }}</textarea>
                                    </div>

                                    {{-- META KEYWORDS --}}
                                    <div class="form-group">
                                        <label for="meta_keywords">
                                            Meta Keywords
                                        </label>

                                        <textarea
                                            name="meta_keywords"
                                            id="meta_keywords"
                                            rows="5"
                                            class="form-control is-invalid"
                                            placeholder="MAX 160 CHARACTERS">{{ old('meta_keywords', $subCategory->meta_keywords) }}</textarea>
                                    </div>

                                </div>

                                {{-- ARABIC --}}
                                <div
                                    class="tab-pane fade"
                                    id="arabic"
                                    role="tabpanel">

                                    {{-- ARABIC CATEGORY --}}
                                    <div class="form-group">
                                        <label for="category_id_ar">
                                            الفئة
                                        </label>

                                        <select
                                            id="category_id_ar"
                                            class="form-control"
                                            dir="rtl">

                                            <option value="">
                                                اختر الفئة
                                            </option>

                                            @foreach($categories as $category)
                                                <option
                                                    value="{{ $category->id }}"
                                                    {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name_ar ?: $category->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    {{-- ARABIC NAME --}}
                                    <div class="form-group">
                                        <label for="name_ar">
                                            الاسم بالعربية
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ old('name_ar', $subCategory->name_ar) }}"
                                            name="name_ar"
                                            id="name_ar"
                                            class="form-control"
                                            dir="rtl"
                                            placeholder="أدخل اسم الفئة الفرعية">

                                        <p class="error name_ar-error"></p>
                                    </div>

                                    {{-- ARABIC DESCRIPTION --}}
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
                                            placeholder="أدخل وصف الفئة الفرعية">{{ old('description_ar', $subCategory->description_ar) }}</textarea>
                                    </div>

                                    {{-- ARABIC META TITLE --}}
                                    <div class="form-group">
                                        <label for="meta_title_ar">
                                            عنوان Meta
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ old('meta_title_ar', $subCategory->meta_title_ar) }}"
                                            name="meta_title_ar"
                                            id="meta_title_ar"
                                            class="form-control"
                                            dir="rtl"
                                            placeholder="عنوان SEO">
                                    </div>

                                    {{-- ARABIC META DESCRIPTION --}}
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
                                            placeholder="وصف SEO">{{ old('meta_description_ar', $subCategory->meta_description_ar) }}</textarea>
                                    </div>

                                    {{-- ARABIC META KEYWORDS --}}
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
                                            placeholder="الكلمات المفتاحية">{{ old('meta_keywords_ar', $subCategory->meta_keywords_ar) }}</textarea>
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
                                        {{ $subCategory->status == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option
                                        value="0"
                                        {{ $subCategory->status == 0 ? 'selected' : '' }}>
                                        Block
                                    </option>

                                </select>
                            </div>

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

<script>

    // UPDATE SUB CATEGORY
    // UPDATE SUB CATEGORY
    $("#editSubCategoryForm").submit(function(event) {

        event.preventDefault();

        const form = $(this);

        const button =
            form.find("button[type='submit']");


        /*
        |--------------------------------------------------------------------------
        | Clear Previous Errors
        |--------------------------------------------------------------------------
        */

        $('.error')
            .html('')
            .hide();

        $('#category_id')
            .removeClass('is-invalid');

        $('#name')
            .removeClass('is-invalid');

        $('#name_ar')
            .removeClass('is-invalid');

        $('#slug')
            .removeClass('is-invalid');


        /*
        |--------------------------------------------------------------------------
        | Disable Button
        |--------------------------------------------------------------------------
        */

        button.prop(
            'disabled',
            true
        );


        /*
        |--------------------------------------------------------------------------
        | Submit AJAX
        |--------------------------------------------------------------------------
        */

        $.ajax({

            url:
                '{{ route("subCategory.update", $subCategory->id) }}',

            type:
                'POST',

            dataType:
                'json',

            data:
                form.serialize(),


            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */

            success: function(response) {

                button.prop(
                    'disabled',
                    false
                );


                if (
                    response.status == 200
                ) {

                    window.location.href =
                        '{{ route("subCategoryList") }}';

                    return;
                }


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
            | Validation / Server Error
            |--------------------------------------------------------------------------
            */

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
                    'Update Error:',
                    xhr.responseText
                );


                alert(
                    'An error occurred while updating the sub category.'
                );
            }

        });

    });



    /*
    |--------------------------------------------------------------------------
    | Show Validation Errors
    |--------------------------------------------------------------------------
    */

    function showErrors(errors) {


        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        if (
            errors.category_id &&
            errors.category_id.length > 0
        ) {

            $('#category_id')
                .addClass('is-invalid');

            $('.category_id-error')
                .html(
                    errors.category_id[0]
                )
                .show();
        }


        /*
        |--------------------------------------------------------------------------
        | English Name
        |--------------------------------------------------------------------------
        */

        if (
            errors.name &&
            errors.name.length > 0
        ) {

            $('#name')
                .addClass('is-invalid');

            $('.name-error')
                .html(
                    errors.name[0]
                )
                .show();
        }


        /*
        |--------------------------------------------------------------------------
        | Arabic Name
        |--------------------------------------------------------------------------
        */

        if (
            errors.name_ar &&
            errors.name_ar.length > 0
        ) {

            $('#name_ar')
                .addClass('is-invalid');

            $('.name_ar-error')
                .html(
                    errors.name_ar[0]
                )
                .show();
        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if (
            errors.slug &&
            errors.slug.length > 0
        ) {

            $('#slug')
                .addClass('is-invalid');

            $('.slug-error')
                .html(
                    errors.slug[0]
                )
                .show();
        }


        /*
        |--------------------------------------------------------------------------
        | Open Correct Language Tab
        |--------------------------------------------------------------------------
        */

        if (
            errors.name_ar
        ) {

            $('#arabic-tab')
                .tab('show');

            localStorage.setItem(
                'sub_category_language',
                'ar'
            );

        } else if (
            errors.name ||
            errors.category_id ||
            errors.slug
        ) {

            $('#english-tab')
                .tab('show');

            localStorage.setItem(
                'sub_category_language',
                'en'
            );
        }

    }



    /*
    |--------------------------------------------------------------------------
    | Clear Errors
    |--------------------------------------------------------------------------
    */

    function clearErrors() {

        $('.error')
            .html('')
            .hide();

        $('#category_id')
            .removeClass('is-invalid');

        $('#name')
            .removeClass('is-invalid');

        $('#name_ar')
            .removeClass('is-invalid');

        $('#slug')
            .removeClass('is-invalid');
    }



    /*
    |--------------------------------------------------------------------------
    | SLUG GENERATION
    |--------------------------------------------------------------------------
    */

    let slugTimer = null;

    $("#name").on(
        'input',
        function() {

            const name =
                $(this)
                    .val()
                    .trim();


            /*
            |--------------------------------------------------------------------------
            | Clear Name Error
            |--------------------------------------------------------------------------
            */

            $('#name')
                .removeClass('is-invalid');

            $('.name-error')
                .html('')
                .hide();


            /*
            |--------------------------------------------------------------------------
            | Empty Name
            |--------------------------------------------------------------------------
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
            | Clear Slug Error
            |--------------------------------------------------------------------------
            */

            $('#slug')
                .removeClass(
                    'is-invalid'
                );

            $('.slug-error')
                .html('')
                .hide();


            /*
            |--------------------------------------------------------------------------
            | Delay Slug Request
            |--------------------------------------------------------------------------
            */

            clearTimeout(
                slugTimer
            );


            slugTimer =
                setTimeout(
                    function() {

                        const button =
                            $("#editSubCategoryForm")
                                .find(
                                    "button[type='submit']"
                                );


                        button.prop(
                            'disabled',
                            true
                        );


                        $.ajax({

                            url:
                                '{{ route("subCategory.slug") }}',

                            type:
                                'GET',

                            data: {

                                name:
                                    name,

                                id:
                                    '{{ $subCategory->id }}'
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

                    },
                    300
                );

        }
    );



    /*
    |--------------------------------------------------------------------------
    | LANGUAGE TAB MEMORY
    |--------------------------------------------------------------------------
    */

    $(document).ready(function() {

        let language =
            localStorage.getItem(
                'sub_category_language'
            );


        if (!language) {

            language = 'en';

            localStorage.setItem(
                'sub_category_language',
                'en'
            );
        }


        if (
            language === 'ar'
        ) {

            $('#arabic-tab')
                .tab('show');

        } else {

            $('#english-tab')
                .tab('show');
        }


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
                        'sub_category_language',
                        'ar'
                    );

                } else {

                    localStorage.setItem(
                        'sub_category_language',
                        'en'
                    );
                }

            }
        );

    });

    // SLUG
    $("#name").change(function() {

        const button = $("button[type='submit']");

        button.prop('disabled', true);

        $.ajax({

            url: '{{ route("subCategory.slug") }}',

            type: 'GET',

            data: {
                name: $(this).val()
            },

            dataType: 'json',

            success: function(response) {

                button.prop('disabled', false);

                $("#slug").val(response.slug);

            },

            error: function() {

                button.prop('disabled', false);

            }

        });

    });


    // LANGUAGE TAB MEMORY
    $(document).ready(function() {

        let language =
            localStorage.getItem('sub_category_language');

        if (!language) {

            language = 'en';

            localStorage.setItem(
                'sub_category_language',
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

                let target =
                    $(e.target).attr('href');

                if (target === '#arabic') {

                    localStorage.setItem(
                        'sub_category_language',
                        'ar'
                    );

                } else {

                    localStorage.setItem(
                        'sub_category_language',
                        'en'
                    );

                }

            }
        );

    });

</script>

@endsection

