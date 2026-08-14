@extends('admin.layouts.app')

@section('content')

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">SUB CATEGORY / Edit</h1>
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


    <!-- Main content -->
    <section class="content h-100">

        <div class="container-fluid h-100">

            <div class="row">

                <div class="col-md-12">

                    <form
                        action=""
                        method="post"
                        name="editSubCategoryForm"
                        id="editSubCategoryForm"
                    >

                        <div class="card">

                            {{-- Header --}}
                            <div class="card-header">

                                <a
                                    href="{{ route('subCategoryList') }}"
                                    class="btn btn-primary"
                                >
                                    Back
                                </a>

                            </div>


                            <div class="card-body">

                                {{-- CATEGORY --}}
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

                                        @if($categories->isNotEmpty())

                                            @foreach ($categories as $category)

                                                <option
                                                    value="{{ $category->id }}"
                                                    {{ ($subCategory->category_id == $category->id) ? 'selected' : '' }}
                                                >
                                                    {{ $category->name }}
                                                </option>

                                            @endforeach

                                        @endif

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
                                        value="{{ $subCategory->name }}"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                    >

                                    <p class="error name-error"></p>

                                </div>


                                {{-- SLUG --}}
                                <div class="form-group">

                                    <label for="slug">
                                        Slug
                                    </label>

                                    <input
                                        type="text"
                                        readonly
                                        name="slug"
                                        id="slug"
                                        value="{{ $subCategory->slug }}"
                                        class="form-control"
                                    >

                                    <p class="error slug-error"></p>

                                </div>


                                {{-- META TITLE --}}
                                <div class="form-group">

                                    <label for="meta_title">
                                        Meta Title
                                    </label>

                                    <input
                                        type="text"
                                        value="{{ $subCategory->meta_title }}"
                                        name="meta_title"
                                        id="meta_title"
                                        class="form-control"
                                        placeholder="MAX 70 CHARACTERS"
                                    >

                                </div>


                                {{-- META DESCRIPTION --}}
                                <div class="form-group">

                                    <label for="meta_description">
                                        Meta Description
                                    </label>

                                    <textarea
                                        name="meta_description"
                                        id="meta_description"
                                        cols="30"
                                        rows="7"
                                        class="form-control"
                                        placeholder="MAX 160 CHARACTERS"
                                    >{{ $subCategory->meta_description }}</textarea>

                                </div>


                                {{-- META KEYWORDS --}}
                                <div class="form-group">

                                    <label for="meta_keywords">
                                        Meta Keywords
                                    </label>

                                    <textarea
                                        name="meta_keywords"
                                        id="meta_keywords"
                                        cols="30"
                                        rows="7"
                                        class="form-control"
                                        placeholder="MAX 160 CHARACTERS"
                                    >{{ $subCategory->meta_keywords }}</textarea>

                                </div>
                                {{-- STATUS --}}
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
                                            {{ ($subCategory->status == 1) ? 'selected' : '' }}
                                        >
                                            Active
                                        </option>

                                        <option
                                            value="0"
                                            {{ ($subCategory->status == 0) ? 'selected' : '' }}
                                        >
                                            Block
                                        </option>

                                    </select>

                                </div>


                                <button
                                    type="submit"
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

    $("#editSubCategoryForm").submit(function(event) {

        event.preventDefault();

        $("button[type='submit']").prop(
            'disabled',
            true
        );


        $.ajax({

            url: '{{ route("subCategory.update", $subCategory->id) }}',

            type: 'POST',

            dataType: 'json',

            data: $("#editSubCategoryForm").serializeArray(),

            success: function(response) {

                $("button[type='submit']").prop(
                    'disabled',
                    false
                );


                if(response.status == 200) {

                    window.location.href =
                        '{{ route("subCategoryList") }}';

                } else {

                    if(response.errors.category_id) {

                        $('.category_id-error').html(
                            response.errors.category_id
                        );

                    } else {

                        $('.category_id-error').html('');

                    }


                    if(response.errors.name) {

                        $('.name-error').html(
                            response.errors.name
                        );

                    } else {

                        $('.name-error').html('');

                    }


                    if(response.errors.slug) {

                        $('.slug-error').html(
                            response.errors.slug
                        );

                    } else {

                        $('.slug-error').html('');

                    }

                }

            }

        });

    });


    $("#name").change(function() {

        $("button[type='submit']").prop(
            'disabled',
            true
        );


        $.ajax({

            url: '{{ route("subCategory.slug") }}',

            type: 'GET',

            data: {
                name: $(this).val()
            },

            dataType: 'json',

            success: function(response) {

                $("button[type='submit']").prop(
                    'disabled',
                    false
                );

                $("#slug").val(response.slug);

            }

        });

    });

</script>

@endsection
