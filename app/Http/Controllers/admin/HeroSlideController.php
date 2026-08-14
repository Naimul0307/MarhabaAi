<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Models\TempFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HeroSlideController extends Controller
{
    public function index(Request $request)
    {
        $query = HeroSlide::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $heroSlides = $query->paginate(20);

        return view('admin.hero_slides.list', [
            'heroSlides' => $heroSlides
        ]);
    }


    public function create()
    {
        return view('admin.hero_slides.create');
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:hero_slides,name',
            'slug' => 'required|unique:hero_slides,slug',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $heroSlide = new HeroSlide();

            $heroSlide->name = $request->name;
            $heroSlide->slug = $request->slug;
            $heroSlide->status = $request->status;

            $heroSlide->save();

            if ($request->image_id > 0) {

                $tempImage = TempFile::where('id', $request->image_id)->first();

                if ($tempImage) {

                    $tempFileName = $tempImage->name;

                    $ext = pathinfo(
                        $tempFileName,
                        PATHINFO_EXTENSION
                    );

                    $newFileName = $heroSlide->slug . '.' . $ext;

                    $sourcePath = public_path(
                        'uploads/temp/' . $tempFileName
                    );

                    $smallDirectory = public_path(
                        'uploads/hero_slides/thumb/small'
                    );

                    $largeDirectory = public_path(
                        'uploads/hero_slides/thumb/large'
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

                        $img = $manager->decodePath($sourcePath);

                        $img->cover(
                            360,
                            220
                        );

                        $img->save(
                            $smallDirectory . DIRECTORY_SEPARATOR . $newFileName
                        );

                        $img = $manager->decodePath($sourcePath);

                        $img->scaleDown(
                            width: 1150
                        );

                        $img->save(
                            $largeDirectory . DIRECTORY_SEPARATOR . $newFileName
                        );

                        $heroSlide->image = $newFileName;

                        $heroSlide->save();

                        File::delete($sourcePath);

                        $tempImage->delete();
                    }
                }
            }

            $request->session()->flash(
                'success',
                'Hero Slide Created Successfully'
            );


            return response()->json([
                'status' => 200,
                'message' => 'Hero Slide Created Successfully'
            ]);
        }

        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }


    public function edit($id)
    {
        $heroSlide = HeroSlide::findOrFail($id);

        return view('admin.hero_slides.edit', [
            'heroSlide' => $heroSlide
        ]);
    }


    public function update(Request $request, $id)
    {
        $heroSlide = HeroSlide::findOrFail($id);


        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:hero_slides,name,' . $heroSlide->id,
            'slug' => 'required|unique:hero_slides,slug,' . $heroSlide->id,
            'status' => 'required',
        ]);


        if ($validator->passes()) {

            $oldImageName = $heroSlide->image;

            $heroSlide->name = $request->name;
            $heroSlide->slug = $request->slug;
            $heroSlide->status = $request->status;

            $heroSlide->save();

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

                    $newFileName = $heroSlide->slug . '.' . $ext;

                    $sourcePath = public_path(
                        'uploads/temp/' . $tempFileName
                    );

                    $smallDirectory = public_path(
                        'uploads/hero_slides/thumb/small'
                    );

                    $largeDirectory = public_path(
                        'uploads/hero_slides/thumb/large'
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
                        $img = $manager->decodePath($sourcePath);

                        $img->cover(
                            360,
                            220
                        );

                        $img->save(
                            $smallDirectory . DIRECTORY_SEPARATOR . $newFileName
                        );

                        $img = $manager->decodePath($sourcePath);

                        $img->scaleDown(
                            width: 1150
                        );

                        $img->save(
                            $largeDirectory . DIRECTORY_SEPARATOR . $newFileName
                        );

                        if (!empty($oldImageName)) {

                            File::delete(
                                $smallDirectory . DIRECTORY_SEPARATOR . $oldImageName
                            );

                            File::delete(
                                $largeDirectory . DIRECTORY_SEPARATOR . $oldImageName
                            );
                        }

                        $heroSlide->image = $newFileName;

                        $heroSlide->save();

                        File::delete($sourcePath);

                        $tempImage->delete();
                    }
                }
            }

            $request->session()->flash(
                'success',
                'Hero Slide Updated Successfully'
            );


            return redirect()->route('heroSlideList');
        }


        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }


    public function delete(Request $request, $id)
    {
        $heroSlide = HeroSlide::find($id);


        if (!$heroSlide) {

            $request->session()->flash(
                'error',
                'Record not found'
            );

            return response([
                'status' => 0
            ]);
        }

        if ($heroSlide->image) {

            File::delete(
                public_path(
                    'uploads/hero_slides/thumb/small/' .
                    $heroSlide->image
                )
            );

            File::delete(
                public_path(
                    'uploads/hero_slides/thumb/large/' .
                    $heroSlide->image
                )
            );
        }

        $heroSlide->delete();


        $request->session()->flash(
            'success',
            'Hero Slide deleted successfully'
        );


        return response([
            'status' => 1
        ]);
    }


    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            HeroSlide::class,
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
        $heroSlide = HeroSlide::findOrFail($id);

        $imageName = $request->input('image');

        if ($heroSlide->image === $imageName) {

            $largeImagePath = public_path(
                'uploads/hero_slides/thumb/large/' .
                $imageName
            );

            $smallImagePath = public_path(
                'uploads/hero_slides/thumb/small/' .
                $imageName
            );

            if (File::exists($largeImagePath)) {
                File::delete($largeImagePath);
            }

            if (File::exists($smallImagePath)) {
                File::delete($smallImagePath);
            }

            $heroSlide->image = null;


            if ($heroSlide->save()) {

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
