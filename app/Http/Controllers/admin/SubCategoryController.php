<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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


        /*
        |--------------------------------------------------------------------------
        | Record Not Found
        |--------------------------------------------------------------------------
        */

        if (!$subCategory) {

            $request->session()->flash(
                'error',
                'Record not found'
            );

            return response()->json([
                'status' => 0,
                'message' => 'Record not found',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Fill Data
        |--------------------------------------------------------------------------
        */

        $this->fillSubCategory(
            $subCategory,
            $request
        );


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $subCategory->save();


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

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
            ], 404);
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
    public function getSlug(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Name
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    'string',
                ],
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
     *
     * Only these fields are validated:
     *
     * category_id
     * name
     * name_ar
     * slug
     * status
     */
    private function validateSubCategory(
        Request $request,
        ?int $id = null
    ) {

        /*
        |--------------------------------------------------------------------------
        | English Name Rule
        |--------------------------------------------------------------------------
        */

        $nameRule = [
            'required',
            'string',
        ];


        if ($id) {

            $nameRule[] = Rule::unique(
                'sub_categories',
                'name'
            )->ignore($id);

        } else {

            $nameRule[] = Rule::unique(
                'sub_categories',
                'name'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Slug Rule
        |--------------------------------------------------------------------------
        */

        $slugRule = [
            'required',
            'string',
        ];


        if ($id) {

            $slugRule[] = Rule::unique(
                'sub_categories',
                'slug'
            )->ignore($id);

        } else {

            $slugRule[] = Rule::unique(
                'sub_categories',
                'slug'
            );
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

                'category_id' => [
                    'required',
                    'exists:categories,id',
                ],


                /*
                |--------------------------------------------------------------------------
                | English Name
                |--------------------------------------------------------------------------
                */

                'name' => $nameRule,


                /*
                |--------------------------------------------------------------------------
                | Arabic Name
                |--------------------------------------------------------------------------
                */

                'name_ar' => [
                    'required',
                    'string',
                ],


                /*
                |--------------------------------------------------------------------------
                | Slug
                |--------------------------------------------------------------------------
                */

                'slug' => $slugRule,


                /*
                |--------------------------------------------------------------------------
                | Status
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
                | Status Messages
                |--------------------------------------------------------------------------
                */

                'status.required' =>
                    'Please select status.',

                'status.in' =>
                    'Invalid status selected.',

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

