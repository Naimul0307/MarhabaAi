<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\TempFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('created_at', 'ASC');

        if (!empty($request->keyword)) {
            $categories = $categories->where(
                'name',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        $categories = $categories->paginate(20);

        return view('admin.category.list', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $category = new Category();

            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = $request->slug;
            $category->meta_title = $request->meta_title?: $request->name . ' | Marhaba AI';
            $category->meta_description = $request->meta_description?: 'EXPLORE OUR ' . $request->name .' SERVICES OFFERED BY Marhaba AI IN DUBAI.';
            $category->meta_keywords = $request->meta_keywords?: 'Marhaba AI, EVENT SERVICES, ' .$request->name . ', DUBAI, UAE';
            $category->image_alt_text = $request->image_alt_text?: $request->name . ' | Marhaba AI';
            $category->status = $request->status;
            $category->save();


            /*
            |--------------------------------------------------------------------------
            | IMAGE UPLOAD
            |--------------------------------------------------------------------------
            */

            if ($request->image_id > 0) {

                $tempImage = TempFile::where('id',$request->image_id)->first();

                if ($tempImage) {

                    $tempFileName = $tempImage->name;

                    $ext = pathinfo($tempFileName,PATHINFO_EXTENSION);

                    $newFileName = $category->slug . '.' . $ext;

                    $sourcePath = public_path('uploads/temp/' . $tempFileName);

                    $smallDirectory = public_path('uploads/categories/thumb/small');

                    $largeDirectory = public_path('uploads/categories/thumb/large');

                    if (!File::exists($smallDirectory)) {File::makeDirectory($smallDirectory,0755,true);
                    }

                    if (!File::exists($largeDirectory)) {File::makeDirectory($largeDirectory,0755,true);
                    }
                    if (File::exists($sourcePath)) {

                        $manager = new ImageManager(new Driver());

                        $img = $manager->decodePath($sourcePath);
                        $img->cover(360,220);
                        $img->save($smallDirectory .DIRECTORY_SEPARATOR .$newFileName);

                        $img = $manager->decodePath($sourcePath);
                        $img->scaleDown(width: 1150);
                        $img->save($largeDirectory .DIRECTORY_SEPARATOR .$newFileName);

                        $category->image = $newFileName;

                        $category->save();

                        File::delete($sourcePath);

                        $tempImage->delete();
                    }
                }
            }

            $request->session()->flash(
                'success',
                'Category Created Successfully'
            );

            return response()->json([
                'status' => 200,
                'message' => 'Category Created Successfully'
            ]);
        }


        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }


    public function edit(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();

        if (empty($category)) {

            $request->session()->flash(
                'error',
                'Record not found in DB'
            );

            return redirect()->route('categoryList');
        }

        return view('admin.category.edit', [
            'category' => $category
        ]);
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (empty($category)) {

            $request->session()->flash(
                'error',
                'Record not found in DB'
            );

            return response()->json([
                'status' => 0
            ]);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $category->id . ',id',
            'slug' => 'required|unique:categories,slug,' .$category->id . ',id',
            'status' => 'required',
        ]);


        if ($validator->passes()) {

            $oldImageName = $category->image;
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->description = $request->description;
            $category->meta_title = $request->meta_title?: $request->name . ' | Marhaba AI';
            $category->meta_description = $request->meta_description?: 'EXPLORE OUR ' . $request->name .' SERVICES OFFERED BY Marhaba AI IN DUBAI.';
            $category->meta_keywords = $request->meta_keywords?: 'Marhaba AI,' .$request->name . ', DUBAI, UAE';
            $category->image_alt_text = $request->image_alt_text?: $request->name . ' | Marhaba AI';

            $category->status = $request->status;

            $category->save();

            if ($request->image_id > 0) {

                $tempImage = TempFile::where(
                    'id',
                    $request->image_id
                )->first();

                if ($tempImage) {

                    $tempFileName = $tempImage->name;

                    $ext = pathinfo(
                        $tempFileName,
                        PATHINFO_EXTENSION
                    );

                    $newFileName = $category->slug . '.' . $ext;

                    $sourcePath = public_path(
                        'uploads/temp/' . $tempFileName
                    );

                    $smallDirectory = public_path(
                        'uploads/categories/thumb/small'
                    );

                    $largeDirectory = public_path(
                        'uploads/categories/thumb/large'
                    );


                    if (!File::exists($smallDirectory)) {
                        File::makeDirectory(
                            $smallDirectory,
                            0755,
                            true
                        );
                    }

                    if (!File::exists($largeDirectory)) {
                        File::makeDirectory(
                            $largeDirectory,
                            0755,
                            true
                        );
                    }


                    if (File::exists($sourcePath)) {

                        $manager = new ImageManager(
                            new Driver()
                        );

                        $img = $manager->decodePath(
                            $sourcePath
                        );

                        $img->cover(
                            360,
                            220
                        );

                        $img->save(
                            $smallDirectory .
                            DIRECTORY_SEPARATOR .
                            $newFileName
                        );

                        $img = $manager->decodePath(
                            $sourcePath
                        );

                        $img->scaleDown(
                            width: 1150
                        );

                        $img->save(
                            $largeDirectory .
                            DIRECTORY_SEPARATOR .
                            $newFileName
                        );


                        if (!empty($oldImageName)) {

                            File::delete(
                                $smallDirectory .
                                DIRECTORY_SEPARATOR .
                                $oldImageName
                            );

                            File::delete(
                                $largeDirectory .
                                DIRECTORY_SEPARATOR .
                                $oldImageName
                            );
                        }

                        $category->image = $newFileName;

                        $category->save();


                        File::delete($sourcePath);

                        $tempImage->delete();
                    }
                }
            }

            $request->session()->flash(
                'success',
                'Category Updated Successfully'
            );

            return response()->json([
                'status' => 200,
                'message' => 'Category Updated Successfully'
            ]);
        }


        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }


    public function delete($id, Request $request)
    {
        $category = Category::where('id', $id)->first();

        if (empty($category)) {

            $request->session()->flash(
                'error',
                'Record not found'
            );

            return response([
                'status' => 0
            ]);
        }

        if ($category->image) {

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


        Category::where('id', $id)->delete();

        $request->session()->flash(
            'success',
            'Category deleted successfully.'
        );

        return response([
            'status' => 1
        ]);
    }


    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Category::class,
            'slug',
            $request->name
        );

        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    }


    public function removeMainImage(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $imageName = $request->input('image');

        if ($category->image === $imageName) {

            $largeImagePath = public_path(
                'uploads/categories/thumb/large/' .
                $imageName
            );

            $smallImagePath = public_path(
                'uploads/categories/thumb/small/' .
                $imageName
            );


            if (File::exists($largeImagePath)) {
                File::delete($largeImagePath);
            }

            if (File::exists($smallImagePath)) {
                File::delete($smallImagePath);
            }


            $category->image = null;


            if ($category->save()) {

                return response()->json([
                    'status' => 200,
                    'message' => 'Main image removed successfully'
                ]);
            }


            return response()->json([
                'status' => 500,
                'message' => 'Failed to remove image from the database'
            ]);
        }


        return response()->json([
            'status' => 400,
            'message' => 'Image not found'
        ]);
    }
}
