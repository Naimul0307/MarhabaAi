<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\TempFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $subCategories = SubCategory::with('category')
            ->orderBy('created_at', 'ASC');

        if (!empty($request->keyword)) {
            $subCategories->where(
                'name',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        $subCategories = $subCategories->paginate(20);

        return view('admin.sub_category.list', [
            'subCategories' => $subCategories
        ]);
    }

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        return view('admin.sub_category.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories,name',
            'slug' => 'required|unique:sub_categories,slug',
            'status' => 'required',
        ]);


        if ($validator->passes()) {

            $subCategory = new SubCategory();

            $subCategory->category_id = $request->category_id;
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;

            $subCategory->meta_title = $request->meta_title
                ?: $request->name .
                ' | Marhaba AI';

            $subCategory->meta_description = $request->meta_description
                ?: 'EXPLORE OUR ' . $request->name .
                ' SERVICES OFFERED BY Marhaba AI IN DUBAI.';

            $subCategory->meta_keywords = $request->meta_keywords
                ?: 'Marhaba AI, ' . $request->name . ', DUBAI, UAE';
            $subCategory->status = $request->status;

            $subCategory->save();

            $request->session()->flash(
                'success',
                'Sub Category Created Successfully'
            );

            return response()->json([
                'status' => 200,
                'message' => 'Sub Category Created Successfully'
            ]);
        }


        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }


    public function edit(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {

            $request->session()->flash(
                'error',
                'Record not found in DB'
            );

            return redirect()->route('subCategoryList');
        }


        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();


        return view('admin.sub_category.edit', [
            'subCategory' => $subCategory,
            'categories' => $categories
        ]);
    }


    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {

            $request->session()->flash(
                'error',
                'Record not found in DB'
            );

            return response()->json([
                'status' => 0
            ]);
        }


        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',

            'name' => 'required|unique:sub_categories,name,' .
                $subCategory->id . ',id',

            'slug' => 'required|unique:sub_categories,slug,' .
                $subCategory->id . ',id',

            'status' => 'required',
        ]);


        if ($validator->passes()) {

            $subCategory->category_id = $request->category_id;
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;

            $subCategory->meta_title = $request->meta_title
                ?: $request->name .
                ' | Marhaba AI';

            $subCategory->meta_description = $request->meta_description
                ?: 'EXPLORE OUR ' . $request->name .
                ' SERVICES OFFERED BY Marhaba AI IN DUBAI.';

            $subCategory->meta_keywords = $request->meta_keywords
                ?: 'Marhaba AI, ' .
                $request->name . ', DUBAI, UAE';

            $subCategory->status = $request->status;

            $subCategory->save();

            $request->session()->flash(
                'success',
                'Sub Category Updated Successfully'
            );

            return response()->json([
                'status' => 200,
                'message' => 'Sub Category Updated Successfully'
            ]);
        }


        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }

    public function delete($id, Request $request)
    {
        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {

            $request->session()->flash(
                'error',
                'Record not found'
            );

            return response([
                'status' => 0
            ]);
        }
        $subCategory->delete();


        $request->session()->flash(
            'success',
            'Sub Category deleted successfully.'
        );

        return response([
            'status' => 1
        ]);
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            SubCategory::class,
            'slug',
            $request->name
        );

        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    }
}
