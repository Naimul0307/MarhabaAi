@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">CATEGORY / List</h1>
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

                <!-- Success Message -->
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <div class="card">

                    <!-- Card Header -->
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">

                            <!-- Create Button -->
                            <div class="card-title mb-0">
                                <a href="{{ route('category.create') }}"
                                   class="btn btn-primary">
                                    Create
                                </a>
                            </div>

                            <!-- Language + Search -->
                            <div class="d-flex align-items-center">

                                <!-- Language Selector -->
                                <div class="mr-2">
                                    <select id="languageSelector"
                                            class="form-control"
                                            style="width: 150px;">

                                        <option value="en">
                                            English
                                        </option>

                                        <option value="ar">
                                            العربية
                                        </option>

                                    </select>
                                </div>

                                <!-- Search -->
                                <div class="card-tools">
                                    <form action="" method="get">
                                        <div class="input-group mb-0"
                                             style="width: 250px;">

                                            <input
                                                type="text"
                                                name="keyword"
                                                value="{{ request('keyword', '') }}"
                                                class="form-control"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit"
                                                        class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover mb-0"
                               id="categoryTable">

                            <thead>
                                <tr>

                                    <!-- ID -->
                                    <th width="50">
                                        ID
                                    </th>

                                    <!-- English Name -->
                                    <th class="en-column">
                                        English Name
                                    </th>

                                    <!-- Arabic Name -->
                                    <th class="ar-column"
                                        dir="rtl">
                                        اسم الفئة
                                    </th>

                                    <!-- Slug -->
                                    <th>
                                        Slug
                                    </th>

                                    <!-- English Description -->
                                    <th class="en-column">
                                        Description
                                    </th>

                                    <!-- Arabic Description -->
                                    <th class="ar-column"
                                        dir="rtl">
                                        الوصف
                                    </th>

                                    <!-- Image -->
                                    <th>
                                        Image
                                    </th>

                                    <!-- Status -->
                                    <th>
                                        Status
                                    </th>

                                    <!-- Action -->
                                    <th>
                                        Action
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                @if(!empty($categories) && count($categories) > 0)

                                    @foreach($categories as $category)

                                        <tr>

                                            <!-- ID -->
                                            <td>
                                                {{ $category->id }}
                                            </td>

                                            <!-- English Name -->
                                            <td class="en-column">
                                                {{ $category->name }}
                                            </td>

                                            <!-- Arabic Name -->
                                            <td class="ar-column"
                                                dir="rtl">
                                                {{ $category->name_ar ?: '—' }}
                                            </td>

                                            <!-- Slug -->
                                            <td>
                                                {{ $category->slug }}
                                            </td>

                                            <!-- English Description -->
                                            <td class="en-column">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $category->description,
                                                    50
                                                ) }}
                                            </td>

                                            <!-- Arabic Description -->
                                            <td class="ar-column"
                                                dir="rtl">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $category->description_ar ?? '',
                                                    50
                                                ) ?: '—' }}
                                            </td>

                                            <!-- Image -->
                                            <td>

                                                @if(
                                                    !empty($category->image) &&
                                                    file_exists(
                                                        public_path(
                                                            'uploads/categories/thumb/small/' .
                                                            $category->image
                                                        )
                                                    )
                                                )

                                                    <img
                                                        src="{{ asset(
                                                            'uploads/categories/thumb/small/' .
                                                            $category->image
                                                        ) }}"
                                                        alt="Category Image"
                                                        width="50"
                                                        height="50"
                                                        class="img-thumbnail"
                                                        style="object-fit: cover;">

                                                @else

                                                    <img
                                                        src="{{ asset('uploads/placeholder.jpg') }}"
                                                        alt="Placeholder"
                                                        width="50"
                                                        height="50"
                                                        class="img-thumbnail"
                                                        style="object-fit: cover;">

                                                @endif

                                            </td>

                                            <!-- Status -->
                                            <td>

                                                @if($category->status == 1)

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge bg-danger">
                                                        Block
                                                    </span>

                                                @endif

                                            </td>

                                            <!-- Action -->
                                            <td>

                                                <!-- Edit -->
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                   title="Edit"
                                                   class="text-primary">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">

                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293z"/>

                                                        <path d="M13.854 4.146l-2-2L4.939 9.061a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.121l6.813-6.813z"/>

                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>

                                                    </svg>

                                                </a>

                                                &nbsp;

                                                <!-- Delete -->
                                                <a href="javascript:void(0);"
                                                   title="Delete"
                                                   class="text-danger"
                                                   onclick="deleteCategory({{ $category->id }});">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-trash"
                                                        viewBox="0 0 16 16">

                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>

                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M14.5 3a.5.5 0 0 1-1 0V2h-3.5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1H2.5A1.5 1.5 0 0 0 1 3.5v.5h1v9A2 2 0 0 0 4 15h8a2 2 0 0 0 2-2V4h1V3h-.5zM4 4h8v9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4z"/>

                                                    </svg>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                @else

                                    <tr>
                                        <td colspan="9"
                                            class="text-center">
                                            Records Not Found
                                        </td>
                                    </tr>

                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>

        <!-- Pagination -->
        @if(!empty($categories))
            <div class="row mt-3">
                <div class="col-md-12">
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif

    </div>
</section>

@endsection

@section('extraJs')

<script type="text/javascript">

    /*
    |--------------------------------------------------------------------------
    | DELETE CATEGORY
    |--------------------------------------------------------------------------
    */

    function deleteCategory(id) {

        if (!confirm("Are you sure you want to delete?")) {
            return;
        }

        $.ajax({
            url: '{{ url("admin/category/delete") }}/' + id,
            type: 'POST',
            dataType: 'json',
            data: {},

            success: function(response) {

                window.location.href =
                    "{{ route('categoryList') }}";

            },

            error: function(xhr) {

                alert(
                    "Something went wrong. Please try again."
                );

            }
        });

    }


    /*
    |--------------------------------------------------------------------------
    | SET LANGUAGE
    |--------------------------------------------------------------------------
    */

    function setLanguage(language) {

        if (language === 'ar') {

            // Hide English columns
            $('.en-column').hide();

            // Show Arabic columns
            $('.ar-column').show();

            // RTL table
            $('#categoryTable').attr('dir', 'rtl');

        } else {

            // Show English columns
            $('.en-column').show();

            // Hide Arabic columns
            $('.ar-column').hide();

            // LTR table
            $('#categoryTable').attr('dir', 'ltr');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | LANGUAGE SELECTOR
    |--------------------------------------------------------------------------
    */

    $(document).on('change', '#languageSelector', function() {

        const language = $(this).val();

        // Save selected language
        localStorage.setItem(
            'category_language',
            language
        );

        // Apply selected language
        setLanguage(language);

    });


    /*
    |--------------------------------------------------------------------------
    | INITIALIZE LANGUAGE
    |--------------------------------------------------------------------------
    */

    $(document).ready(function() {

        let language =
            localStorage.getItem('category_language');

        // Default language
        if (!language) {

            language = 'en';

            localStorage.setItem(
                'category_language',
                'en'
            );

        }

        // Set selected option
        $('#languageSelector').val(language);

        // Apply language
        setLanguage(language);

    });

</script>

@endsection
