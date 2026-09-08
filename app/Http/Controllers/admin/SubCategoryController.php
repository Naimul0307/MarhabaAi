<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Sub Category List
     */
    public function index(Request $request)
    {
        $subCategories = SubCategory::with('category')
            ->orderBy('created_at', 'ASC');

        if ($request->filled('keyword')) {

            $keyword = $request->keyword;

            $subCategories->where(function ($query) use ($keyword) {

                $query->where(
                    'name',
                    'like',
                    "%{$keyword}%"
                )->orWhere(
                    'name_ar',
                    'like',
                    "%{$keyword}%"
                );

            });
        }

        return view('admin.sub_category.list', [
            'subCategories' => $subCategories->paginate(20),
        ]);
    }


    /**
     * Create Page
     */
    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        return view('admin.sub_category.create', [
            'categories' => $categories,
        ]);
    }


    /**
     * Store Sub Category
     */
    public function store(Request $request)
    {
        $validator = $this->validateSubCategory($request);

        if ($validator->fails()) {

            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
            ], 422);
        }

        $subCategory = new SubCategory();

        $this->fillSubCategory(
            $subCategory,
            $request
        );

        $subCategory->save();

        $request->session()->flash(
            'success',
            'Sub Category Created Successfully'
        );

        return response()->json([
            'status' => 200,
            'message' => 'Sub Category Created Successfully',
        ]);
    }


    /**
     * Edit Page
     */
    public function edit(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {

            $request->session()->flash(
                'error',
                'Record not found in DB'
            );

            return redirect()->route(
                'subCategoryList'
            );
        }

        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        return view('admin.sub_category.edit', [
            'subCategory' => $subCategory,
            'categories' => $categories,
        ]);
    }


    /**
     * Update Sub Category
     */
    public function update(
        Request $request,
        $id
    ) {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {

            $request->session()->flash(
                'error',
                'Record not found in DB'
            );

            return response()->json([
                'status' => 0,
                'message' => 'Record not found',
            ], 404);
        }

        $validator = $this->validateSubCategory(
            $request,
            $subCategory->id
        );

        if ($validator->fails()) {

            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
            ], 422);
        }

        $this->fillSubCategory(
            $subCategory,
            $request
        );

        $subCategory->save();

        $request->session()->flash(
            'success',
            'Sub Category Updated Successfully'
        );

        return response()->json([
            'status' => 200,
            'message' => 'Sub Category Updated Successfully',
        ]);
    }


    /**
     * Delete
     */
    public function delete(
        $id,
        Request $request
    ) {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {

            $request->session()->flash(
                'error',
                'Record not found'
            );

            return response()->json([
                'status' => 0,
            ]);
        }

        $subCategory->delete();

        $request->session()->flash(
            'success',
            'Sub Category deleted successfully.'
        );

        return response()->json([
            'status' => 1,
        ]);
    }


    /**
     * Generate Slug
     */
/**
 * Generate Slug
 */
public function getSlug(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'name' => 'required|string',
        ],
        [
            'name.required' =>
                'English sub category name is required.',
        ]
    );

    if ($validator->fails()) {

        return response()->json([
            'status' => 0,

            'errors' => [
                'name' => $validator
                    ->errors()
                    ->get('name'),
            ],
        ], 422);
    }

    /*
    |--------------------------------------------------------------------------
    | Current Sub Category ID
    |--------------------------------------------------------------------------
    */

    $subCategoryId = $request->input('id');


    /*
    |--------------------------------------------------------------------------
    | Generate Slug
    |--------------------------------------------------------------------------
    */

    $slug = SlugService::createSlug(
        SubCategory::class,
        'slug',
        $request->name
    );


    /*
    |--------------------------------------------------------------------------
    | Check Existing Slug
    |--------------------------------------------------------------------------
    |
    | Ignore current sub category during edit.
    |
    */

    $slugExists = SubCategory::where(
        'slug',
        $slug
    )
    ->when(
        $subCategoryId,
        function ($query) use ($subCategoryId) {

            $query->where(
                'id',
                '!=',
                $subCategoryId
            );
        }
    )
    ->exists();


    /*
    |--------------------------------------------------------------------------
    | Generate Alternative Slug
    |--------------------------------------------------------------------------
    */

    if ($slugExists) {

        $slug = SlugService::createSlug(
            SubCategory::class,
            'slug',
            $request->name . '-' . time()
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Return Slug
    |--------------------------------------------------------------------------
    */

    return response()->json([
        'status' => 200,
        'slug' => $slug,
    ]);
}

    /**
     * Validate Sub Category
     */
    private function validateSubCategory(
        Request $request,
        ?int $id = null
    ) {

        /*
        |--------------------------------------------------------------------------
        | Unique Name
        |--------------------------------------------------------------------------
        */

        $nameUnique =
            'unique:sub_categories,name';

        if ($id) {

            $nameUnique .=
                ',' . $id . ',id';
        }


        /*
        |--------------------------------------------------------------------------
        | Unique Slug
        |--------------------------------------------------------------------------
        */

        $slugUnique =
            'unique:sub_categories,slug';

        if ($id) {

            $slugUnique .=
                ',' . $id . ',id';
        }


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        return Validator::make(
            $request->all(),
            [

                /*
                |--------------------------------------------------------------------------
                | Category
                |--------------------------------------------------------------------------
                */

                'category_id' =>
                    'required|exists:categories,id',


                /*
                |--------------------------------------------------------------------------
                | English Name
                |--------------------------------------------------------------------------
                */

                'name' => [
                    'required',
                    'string',
                    $nameUnique,
                ],


                /*
                |--------------------------------------------------------------------------
                | Arabic Name
                |--------------------------------------------------------------------------
                */

                'name_ar' =>
                    'required|string',


                /*
                |--------------------------------------------------------------------------
                | English Description
                |--------------------------------------------------------------------------
                */

                'description' =>
                    'nullable|string',


                /*
                |--------------------------------------------------------------------------
                | Arabic Description
                |--------------------------------------------------------------------------
                */

                'description_ar' =>
                    'nullable|string',


                /*
                |--------------------------------------------------------------------------
                | English Meta Title
                |--------------------------------------------------------------------------
                */

                'meta_title' =>
                    'nullable|string|max:70',


                /*
                |--------------------------------------------------------------------------
                | Arabic Meta Title
                |--------------------------------------------------------------------------
                */

                'meta_title_ar' =>
                    'nullable|string|max:70',


                /*
                |--------------------------------------------------------------------------
                | English Meta Description
                |--------------------------------------------------------------------------
                */

                'meta_description' =>
                    'nullable|string|max:160',


                /*
                |--------------------------------------------------------------------------
                | Arabic Meta Description
                |--------------------------------------------------------------------------
                */

                'meta_description_ar' =>
                    'nullable|string|max:160',


                /*
                |--------------------------------------------------------------------------
                | English Keywords
                |--------------------------------------------------------------------------
                */

                'meta_keywords' =>
                    'nullable|string',


                /*
                |--------------------------------------------------------------------------
                | Arabic Keywords
                |--------------------------------------------------------------------------
                */

                'meta_keywords_ar' =>
                    'nullable|string',


                /*
                |--------------------------------------------------------------------------
                | Slug
                |--------------------------------------------------------------------------
                */

                'slug' => [
                    'required',
                    'string',
                    $slugUnique,
                ],


                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                */

                'status' =>
                    'required|in:0,1',
            ],
            [

                /*
                |--------------------------------------------------------------------------
                | Category Messages
                |--------------------------------------------------------------------------
                */

                'category_id.required' =>
                    'Please select a category.',

                'category_id.exists' =>
                    'Selected category does not exist.',


                /*
                |--------------------------------------------------------------------------
                | English Name Messages
                |--------------------------------------------------------------------------
                */

                'name.required' =>
                    'English sub category name is required.',

                'name.unique' =>
                    'This English sub category name already exists.',


                /*
                |--------------------------------------------------------------------------
                | Arabic Name Messages
                |--------------------------------------------------------------------------
                */

                'name_ar.required' =>
                    'اسم الفئة الفرعية بالعربية مطلوب.',


                /*
                |--------------------------------------------------------------------------
                | Slug Messages
                |--------------------------------------------------------------------------
                */

                'slug.required' =>
                    'Slug is required.',

                'slug.unique' =>
                    'This slug already exists.',


                /*
                |--------------------------------------------------------------------------
                | Meta Messages
                |--------------------------------------------------------------------------
                */

                'meta_title.max' =>
                    'Meta title cannot exceed 70 characters.',

                'meta_title_ar.max' =>
                    'عنوان Meta لا يمكن أن يتجاوز 70 حرفًا.',

                'meta_description.max' =>
                    'Meta description cannot exceed 160 characters.',

                'meta_description_ar.max' =>
                    'وصف Meta لا يمكن أن يتجاوز 160 حرفًا.',
            ]
        );
    }


    /**
     * Fill Sub Category
     */
    private function fillSubCategory(
        SubCategory $subCategory,
        Request $request
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        $subCategory->category_id =
            $request->category_id;


        /*
        |--------------------------------------------------------------------------
        | Names
        |--------------------------------------------------------------------------
        */

        $subCategory->name =
            $request->name;

        $subCategory->name_ar =
            $request->name_ar;


        /*
        |--------------------------------------------------------------------------
        | Descriptions
        |--------------------------------------------------------------------------
        */

        $subCategory->description =
            $request->description;

        $subCategory->description_ar =
            $request->description_ar;


        /*
        |--------------------------------------------------------------------------
        | English Meta
        |--------------------------------------------------------------------------
        */

        $subCategory->meta_title =
            $request->meta_title
            ?: $request->name . ' | Marhaba AI';

        $subCategory->meta_description =
            $request->meta_description
            ?: 'EXPLORE OUR '
            . $request->name
            . ' SERVICES OFFERED BY Marhaba AI IN DUBAI.';

        $subCategory->meta_keywords =
            $request->meta_keywords
            ?: 'Marhaba AI, '
            . $request->name
            . ', DUBAI, UAE';


        /*
        |--------------------------------------------------------------------------
        | Arabic Meta
        |--------------------------------------------------------------------------
        */

        $subCategory->meta_title_ar =
            $request->meta_title_ar
            ?: (
                $request->name_ar
                ? $request->name_ar . ' | Marhaba AI'
                : null
            );

        $subCategory->meta_description_ar =
            $request->meta_description_ar
            ?: (
                $request->name_ar
                ? 'اكتشف خدمات '
                    . $request->name_ar
                    . ' المقدمة من Marhaba AI في دبي.'
                    : null
            );

        $subCategory->meta_keywords_ar =
            $request->meta_keywords_ar
            ?: (
                $request->name_ar
                ? 'Marhaba AI, خدمات الفعاليات, '
                    . $request->name_ar
                    . ', دبي, الإمارات'
                : null
            );


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $subCategory->slug =
            $request->slug;


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $subCategory->status =
            $request->status;
    }
}
