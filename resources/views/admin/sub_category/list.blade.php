@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">SUB CATEGORY / List</h1>
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

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">

                            <div class="card-title mb-0">
                                <a href="{{ route('subCategory.create') }}"
                                   class="btn btn-primary">
                                    Create
                                </a>
                            </div>

                            <div class="d-flex align-items-center">

                                <div class="mr-2">
                                    <select id="languageSelector"
                                            class="form-control"
                                            style="width: 150px;">

                                        <option value="en">English</option>
                                        <option value="ar">العربية</option>

                                    </select>
                                </div>

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

                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover mb-0"
                               id="subCategoryTable">

                            <thead>
                                <tr>

                                    <th width="50">
                                        ID
                                    </th>

                                    <th class="en-column">
                                        English Name
                                    </th>

                                    <th class="ar-column" dir="rtl">
                                        اسم الفئة الفرعية
                                    </th>

                                    <th>
                                        Slug
                                    </th>

                                    <th class="en-column">
                                        Category
                                    </th>

                                    <th class="ar-column" dir="rtl">
                                        الفئة
                                    </th>

                                    <th class="en-column">
                                        Description
                                    </th>

                                    <th class="ar-column" dir="rtl">
                                        الوصف
                                    </th>

                                    <th class="en-column">
                                        Meta Title
                                    </th>

                                    <th class="ar-column" dir="rtl">
                                        عنوان الميتا
                                    </th>

                                    <th class="en-column">
                                        Meta Keywords
                                    </th>

                                    <th class="ar-column" dir="rtl">
                                        الكلمات المفتاحية
                                    </th>

                                    <th class="en-column">
                                        Meta Description
                                    </th>

                                    <th class="ar-column" dir="rtl">
                                        وصف الميتا
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                @if(!empty($subCategories) && count($subCategories) > 0)

                                    @foreach($subCategories as $subCategory)

                                        <tr>

                                            <td>
                                                {{ $subCategory->id }}
                                            </td>

                                            <td class="en-column">
                                                {{ $subCategory->name }}
                                            </td>

                                            <td class="ar-column" dir="rtl">
                                                {{ $subCategory->name_ar ?: '—' }}
                                            </td>

                                            <td>
                                                {{ $subCategory->slug }}
                                            </td>

                                            <td class="en-column">
                                                @if($subCategory->category)
                                                    {{ $subCategory->category->name }}
                                                @else
                                                    <span class="text-danger">
                                                        Category Not Found
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="ar-column" dir="rtl">
                                                @if($subCategory->category)
                                                    {{ $subCategory->category->name_ar ?: '—' }}
                                                @else
                                                    <span class="text-danger">
                                                        الفئة غير موجودة
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="en-column">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $subCategory->description,
                                                    50
                                                ) ?: '—' }}
                                            </td>

                                            <td class="ar-column" dir="rtl">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $subCategory->description_ar ?? '',
                                                    50
                                                ) ?: '—' }}
                                            </td>

                                            <td class="en-column">
                                                {{ $subCategory->meta_title ?: '—' }}
                                            </td>

                                            <td class="ar-column" dir="rtl">
                                                {{ $subCategory->meta_title_ar ?: '—' }}
                                            </td>

                                            <td class="en-column">
                                                {{ $subCategory->meta_keywords ?: '—' }}
                                            </td>

                                            <td class="ar-column" dir="rtl">
                                                {{ $subCategory->meta_keywords_ar ?: '—' }}
                                            </td>

                                            <td class="en-column">
                                                {{ $subCategory->meta_description ?: '—' }}
                                            </td>

                                            <td class="ar-column" dir="rtl">
                                                {{ $subCategory->meta_description_ar ?: '—' }}
                                            </td>

                                            <td>
                                                @if($subCategory->status == 1)
                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Block
                                                    </span>
                                                @endif
                                            </td>

                                            <td>

                                                <a href="{{ route(
                                                    'subCategory.edit',
                                                    $subCategory->id
                                                ) }}"
                                                   title="Edit"
                                                   class="text-primary">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        viewBox="0 0 16 16">

                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293z"/>

                                                        <path d="M13.854 4.146l-2-2L4.939 9.061a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.121l6.813-6.813z"/>

                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>

                                                    </svg>

                                                </a>

                                                &nbsp;

                                                <a href="javascript:void(0);"
                                                   title="Delete"
                                                   class="text-danger"
                                                   onclick="deleteSubCategory({{ $subCategory->id }});">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        viewBox="0 0 16 16">

                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>

                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>

                                                    </svg>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                @else

                                    <tr>
                                        <td colspan="16"
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

        @if(!empty($subCategories))

            <div class="row mt-3">
                <div class="col-md-12">
                    {{ $subCategories->links('pagination::bootstrap-4') }}
                </div>
            </div>

        @endif

    </div>
</section>

@endsection

@section('extraJs')

<script>

function deleteSubCategory(id) {

    if (!confirm('Are you sure you want to delete?')) {
        return;
    }

    $.ajax({
        url: '{{ url("admin/sub-category/delete") }}/' + id,
        type: 'POST',
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            window.location.href = "{{ route('subCategoryList') }}";
        },
        error: function() {
            alert('Something went wrong. Please try again.');
        }
    });
}

function setLanguage(language) {

    if (language === 'ar') {

        $('.en-column').hide();
        $('.ar-column').show();

        $('#subCategoryTable').attr('dir', 'rtl');

    } else {

        $('.en-column').show();
        $('.ar-column').hide();

        $('#subCategoryTable').attr('dir', 'ltr');
    }
}

$(document).on('change', '#languageSelector', function() {

    const language = $(this).val();

    localStorage.setItem(
        'sub_category_language',
        language
    );

    setLanguage(language);
});

$(document).ready(function() {

    let language = localStorage.getItem(
        'sub_category_language'
    );

    if (!language) {
        language = 'en';

        localStorage.setItem(
            'sub_category_language',
            'en'
        );
    }

    $('#languageSelector').val(language);

    setLanguage(language);
});

</script>

@endsection

