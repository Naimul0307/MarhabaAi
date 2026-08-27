@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sub Category / Create</h1>
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
                <form action="" method="post" id="createSubCategoryForm">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('subCategoryList') }}" class="btn btn-primary">Back</a>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select a category</option>
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error category_id-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <p class="error name-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" readonly>
                                <p class="error slug-error"></p>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control" placeholder="MAX 160 CHARACTERS"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="MAX 70 CHARACTERS">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="4" class="form-control" placeholder="MAX 160 CHARACTERS"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea name="meta_keywords" id="meta_keywords" rows="4" class="form-control" placeholder="MAX 160 CHARACTERS"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

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
$("#createSubCategoryForm").submit(function(event) {
    event.preventDefault();

    const button = $("button[type='submit']");
    button.prop('disabled', true);

    $.ajax({
        url: '{{ route("subCategory.save") }}',
        type: 'POST',
        dataType: 'json',
        data: $(this).serializeArray(),

        success: function(response) {
            button.prop('disabled', false);

            if (response.status == 200) {
                window.location.href = '{{ route("subCategoryList") }}';
                return;
            }

            $('.category_id-error').html(response.errors.category_id || '');
            $('.name-error').html(response.errors.name || '');
            $('.slug-error').html(response.errors.slug || '');
        }
    });
});

$("#name").change(function() {
    const button = $("button[type='submit']");
    button.prop('disabled', true);

    $.ajax({
        url: '{{ route("subCategory.slug") }}',
        type: 'GET',
        data: { name: $(this).val() },
        dataType: 'json',

        success: function(response) {
            button.prop('disabled', false);
            $("#slug").val(response.slug);
        }
    });
});
</script>
@endsection
