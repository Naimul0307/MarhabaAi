<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TempFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    /**
     * Category List
     */
    public function index(Request $request)
    {
        $categories = Category::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $categories->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('name_ar', 'like', '%' . $search . '%');
            });
        }

        $categories = $categories->paginate(20);

        return view('admin.category.list', compact('categories'));
    }

    /**
     * Create Category Page
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store Category
     */
    public function store(Request $request)
    {
        $validator = $this->validateCategory($request);

        /*
        |--------------------------------------------------------------------------
        | ONLY RETURN NAME AND SLUG ERRORS
        |--------------------------------------------------------------------------
        */

        if ($validator->fails()) {

            return response()->json([
                'status' => 0,
                'errors' => [
                    'name'    => $validator->errors()->get('name'),
                    'name_ar' => $validator->errors()->get('name_ar'),
                    'slug'    => $validator->errors()->get('slug'),
                ],
            ], 422);
        }

        $category = new Category();

        $this->fillCategory(
            $category,
            $request
        );

        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        if (!empty($request->image_id)) {

            $tempImage = TempFile::find($request->image_id);

            if ($tempImage) {

                $sourcePath = public_path(
                    'uploads/temp/' . $tempImage->name
                );

                if (File::exists($sourcePath)) {

                    $manager = new ImageManager(
                        new Driver()
                    );

                    $image = $manager->read($sourcePath);

                    /*
                    |--------------------------------------------------------------------------
                    | SMALL IMAGE
                    |--------------------------------------------------------------------------
                    */

                    $smallImage = $image->cover(
                        360,
                        220
                    );

                    $smallPath = public_path(
                        'uploads/categories/thumb/small/' . $tempImage->name
                    );

                    File::ensureDirectoryExists(
                        dirname($smallPath)
                    );

                    $smallImage->save(
                        $smallPath
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | LARGE IMAGE
                    |--------------------------------------------------------------------------
                    */

                    $largeImage = $image->scaleDown(
                        width: 1150
                    );

                    $largePath = public_path(
                        'uploads/categories/thumb/large/' . $tempImage->name
                    );

                    File::ensureDirectoryExists(
                        dirname($largePath)
                    );

                    $largeImage->save(
                        $largePath
                    );

                    $category->image = $tempImage->name;

                    $category->save();

                    /*
                    |--------------------------------------------------------------------------
                    | DELETE TEMP IMAGE
                    |--------------------------------------------------------------------------
                    */

                    File::delete(
                        $sourcePath
                    );

                    $tempImage->delete();
                }
            }
        } else {

            $category->save();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Category created successfully.',
        ]);
    }

    /**
     * Edit Category
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view(
            'admin.category.edit',
            compact('category')
        );
    }

    /**
     * Update Category
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = $this->validateCategory(
            $request,
            $id
        );

        /*
        |--------------------------------------------------------------------------
        | ONLY RETURN NAME AND SLUG ERRORS
        |--------------------------------------------------------------------------
        */

        if ($validator->fails()) {

            return response()->json([
                'status' => 0,
                'errors' => [
                    'name' => $validator->errors()->get('name'),
                    'name_ar' => $validator->errors()->get('name_ar'),
                    'slug' => $validator->errors()->get('slug'),
                ],
            ], 422);
        }

        $oldImage = $category->image;

        $this->fillCategory(
            $category,
            $request
        );

        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        if (!empty($request->image_id)) {

            $tempImage = TempFile::find(
                $request->image_id
            );

            if ($tempImage) {

                $sourcePath = public_path(
                    'uploads/temp/' . $tempImage->name
                );

                if (File::exists($sourcePath)) {

                    $manager = new ImageManager(
                        new Driver()
                    );

                    $image = $manager->read(
                        $sourcePath
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | SMALL IMAGE
                    |--------------------------------------------------------------------------
                    */

                    $smallImage = $image->cover(
                        360,
                        220
                    );

                    $smallPath = public_path(
                        'uploads/categories/thumb/small/' . $tempImage->name
                    );

                    File::ensureDirectoryExists(
                        dirname($smallPath)
                    );

                    $smallImage->save(
                        $smallPath
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | LARGE IMAGE
                    |--------------------------------------------------------------------------
                    */

                    $largeImage = $image->scaleDown(
                        width: 1150
                    );

                    $largePath = public_path(
                        'uploads/categories/thumb/large/' . $tempImage->name
                    );

                    File::ensureDirectoryExists(
                        dirname($largePath)
                    );

                    $largeImage->save(
                        $largePath
                    );

                    $category->image = $tempImage->name;

                    /*
                    |--------------------------------------------------------------------------
                    | DELETE OLD IMAGE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !empty($oldImage) &&
                        $oldImage != $tempImage->name
                    ) {

                        File::delete(
                            public_path(
                                'uploads/categories/thumb/small/' . $oldImage
                            )
                        );

                        File::delete(
                            public_path(
                                'uploads/categories/thumb/large/' . $oldImage
                            )
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | DELETE TEMP IMAGE
                    |--------------------------------------------------------------------------
                    */

                    File::delete(
                        $sourcePath
                    );

                    $tempImage->delete();
                }
            }
        }

        $category->save();

        return response()->json([
            'status' => 1,
            'message' => 'Category updated successfully.',
        ]);
    }

    /**
     * Validate Category
     */
    private function validateCategory(
        Request $request,
        $id = null
    ) {
        $nameUnique = 'unique:categories,name';

        $slugUnique = 'unique:categories,slug';

        if ($id) {

            $nameUnique .= ',' . $id;

            $slugUnique .= ',' . $id;
        }

        return Validator::make(
            $request->all(),
            [

                /*
                |--------------------------------------------------------------------------
                | NAME
                |--------------------------------------------------------------------------
                */

                'name' => [
                    'required',
                    'string',
                    $nameUnique,
                ],

                /*
                |--------------------------------------------------------------------------
                | ARABIC NAME
                |--------------------------------------------------------------------------
                */

                'name_ar' => [
                    'required',
                    'string',
                ],

                /*
                |--------------------------------------------------------------------------
                | DESCRIPTION
                |--------------------------------------------------------------------------
                */

                'description' => [
                    'nullable',
                    'string',
                ],

                'description_ar' => [
                    'nullable',
                    'string',
                ],

                /*
                |--------------------------------------------------------------------------
                | META
                |--------------------------------------------------------------------------
                */

                'meta_title' => [
                    'nullable',
                    'string',
                    'max:70',
                ],

                'meta_title_ar' => [
                    'nullable',
                    'string',
                    'max:70',
                ],

                'meta_description' => [
                    'nullable',
                    'string',
                    'max:160',
                ],

                'meta_description_ar' => [
                    'nullable',
                    'string',
                    'max:160',
                ],

                'meta_keywords' => [
                    'nullable',
                    'string',
                ],

                'meta_keywords_ar' => [
                    'nullable',
                    'string',
                ],

                /*
                |--------------------------------------------------------------------------
                | SLUG
                |--------------------------------------------------------------------------
                */

                'slug' => [
                    'required',
                    'string',
                    $slugUnique,
                ],

                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                'status' => [
                    'required',
                    'in:0,1',
                ],
            ],
            [

                /*
                |--------------------------------------------------------------------------
                | CUSTOM MESSAGES
                |--------------------------------------------------------------------------
                */

                'name.required' =>
                    'Category name is required.',

                'name.string' =>
                    'Category name must be a valid string.',

                'name.unique' =>
                    'This category name already exists.',

                'name_ar.required' =>
                    'Arabic category name is required.',

                'slug.required' =>
                    'Slug is required.',

                'slug.unique' =>
                    'This slug already exists.',

            ]
        );
    }

    /**
     * Fill Category
     */
    private function fillCategory(
        Category $category,
        Request $request
    ) {
        $category->name =
            $request->name;

        $category->name_ar =
            $request->name_ar;

        $category->description =
            $request->description;

        $category->description_ar =
            $request->description_ar;

        $category->meta_title =
            $request->meta_title
                ?: $request->name;

        $category->meta_title_ar =
            $request->meta_title_ar
                ?: $request->name_ar;

        $category->meta_description =
            $request->meta_description;

        $category->meta_description_ar =
            $request->meta_description_ar;

        $category->meta_keywords =
            $request->meta_keywords;

        $category->meta_keywords_ar =
            $request->meta_keywords_ar;

        $category->slug =
            $request->slug;

        $category->status =
            $request->status;
    }

    /**
     * Generate Slug
     */
   public function getSlug(Request $request)
{
    $slug = SlugService::createSlug(
        Category::class,
        'slug',
        $request->name
    );

    /*
    |--------------------------------------------------------------------------
    | CHECK EXISTING SLUG
    |--------------------------------------------------------------------------
    */

    $query = Category::where('slug', $slug);

    if (!empty($request->id)) {
        $query->where('id', '!=', $request->id);
    }

    if ($query->exists()) {

        $slug = SlugService::createSlug(
            Category::class,
            'slug',
            $request->name . '-' . time()
        );
    }

    return response()->json([
        'status' => 1,
        'slug'   => $slug,
    ]);
}
    /**
     * Remove Category Image
     */
    public function removeMainImage(
        Request $request
    ) {
        $category = Category::find(
            $request->id
        );

        if (!$category) {

            return response()->json([
                'status' => 0,
                'message' => 'Category not found.',
            ], 404);
        }

        if (
            empty($category->image) ||
            $category->image != $request->image
        ) {

            return response()->json([
                'status' => 0,
                'message' => 'Invalid image.',
            ], 422);
        }

        File::delete(
            public_path(
                'uploads/categories/thumb/small/' .
                $category->image
            )
        );

        File::delete(
            public_path(
                'uploads/categories/thumb/large/' .
                $category->image
            )
        );

        $category->image = null;

        $category->save();

        return response()->json([
            'status' => 1,
            'message' => 'Image removed successfully.',
        ]);
    }

    /**
     * Delete Category
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if (!empty($category->image)) {

            File::delete(
                public_path(
                    'uploads/categories/thumb/small/' .
                    $category->image
                )
            );

            File::delete(
                public_path(
                    'uploads/categories/thumb/large/' .
                    $category->image
                )
            );
        }

        $category->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Category deleted successfully.',
        ]);
    }
}
