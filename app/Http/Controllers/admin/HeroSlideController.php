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
    /*
    |--------------------------------------------------------------------------
    | Hero Slide List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = HeroSlide::orderBy(
            'created_at',
            'DESC'
        );


        if (!empty($request->keyword)) {

            $keyword = $request->keyword;


            $query->where(function ($query) use ($keyword) {

                $query->where(
                    'name',
                    'like',
                    '%' . $keyword . '%'
                )

                ->orWhere(
                    'name_ar',
                    'like',
                    '%' . $keyword . '%'
                );

            });

        }


        $heroSlides = $query->paginate(20);


        return view(
            'admin.hero_slides.list',
            [
                'heroSlides' => $heroSlides
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create Hero Slide
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.hero_slides.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Hero Slide
    |--------------------------------------------------------------------------
    */

    public function save(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:hero_slides,name',

                'name_ar' => 'required|string',

                'slug' => 'required|unique:hero_slides,slug',

                'status' => 'required',
            ]
        );


        if ($validator->passes()) {


            $heroSlide = new HeroSlide();


            /*
            |--------------------------------------------------------------
            | Save Data
            |--------------------------------------------------------------
            */

            $heroSlide->name =
                $request->name;

            $heroSlide->name_ar =
                $request->name_ar;

            $heroSlide->slug =
                $request->slug;

            $heroSlide->status =
                $request->status;


            $heroSlide->save();


            /*
            |--------------------------------------------------------------
            | Image Upload
            |--------------------------------------------------------------
            */

            if ($request->image_id > 0) {


                $tempImage =
                    TempFile::where(
                        'id',
                        $request->image_id
                    )->first();


                if ($tempImage) {


                    $tempFileName =
                        $tempImage->name;


                    $ext = pathinfo(
                        $tempFileName,
                        PATHINFO_EXTENSION
                    );


                    $newFileName =
                        $heroSlide->slug .
                        '.' .
                        $ext;


                    $sourcePath =
                        public_path(
                            'uploads/temp/' .
                            $tempFileName
                        );


                    $smallDirectory =
                        public_path(
                            'uploads/hero_slides/thumb/small'
                        );


                    $largeDirectory =
                        public_path(
                            'uploads/hero_slides/thumb/large'
                        );


                    /*
                    |------------------------------------------------------
                    | Create Directories
                    |------------------------------------------------------
                    */

                    if (
                        !File::exists(
                            $smallDirectory
                        )
                    ) {

                        File::makeDirectory(
                            $smallDirectory,
                            0755,
                            true
                        );

                    }


                    if (
                        !File::exists(
                            $largeDirectory
                        )
                    ) {

                        File::makeDirectory(
                            $largeDirectory,
                            0755,
                            true
                        );

                    }


                    if (
                        File::exists(
                            $sourcePath
                        )
                    ) {


                        $manager =
                            new ImageManager(
                                new Driver()
                            );


                        /*
                        |--------------------------------------------------
                        | Small Image
                        |--------------------------------------------------
                        */

                        $img =
                            $manager->decodePath(
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


                        /*
                        |--------------------------------------------------
                        | Large Image
                        |--------------------------------------------------
                        */

                        $img =
                            $manager->decodePath(
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


                        /*
                        |--------------------------------------------------
                        | Save Image
                        |--------------------------------------------------
                        */

                        $heroSlide->image =
                            $newFileName;


                        $heroSlide->save();


                        /*
                        |--------------------------------------------------
                        | Delete Temporary File
                        |--------------------------------------------------
                        */

                        File::delete(
                            $sourcePath
                        );


                        $tempImage->delete();

                    }

                }

            }


            /*
            |--------------------------------------------------------------
            | Success Message
            |--------------------------------------------------------------
            */

            $request->session()->flash(
                'success',
                'Hero Slide Created Successfully'
            );


            /*
            |--------------------------------------------------------------
            | JSON Response
            |--------------------------------------------------------------
            */

            return response()->json(
                [
                    'status' => 200,

                    'message' =>
                        'Hero Slide Created Successfully'
                ]
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Validation Error
        |--------------------------------------------------------------------------
        */

        return response()->json(
            [
                'status' => 0,

                'errors' =>
                    $validator->errors()
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Hero Slide
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $heroSlide =
            HeroSlide::findOrFail($id);


        return view(
            'admin.hero_slides.edit',
            [
                'heroSlide' => $heroSlide
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Hero Slide
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {

        $heroSlide =
            HeroSlide::findOrFail($id);


        $validator = Validator::make(
            $request->all(),
            [

                'name' =>
                    'required|unique:hero_slides,name,' .
                    $heroSlide->id,

                'name_ar' => 'required|string',

                'slug' =>
                    'required|unique:hero_slides,slug,' .
                    $heroSlide->id,

                'status' =>
                    'required',

            ]
        );


        if ($validator->passes()) {


            /*
            |--------------------------------------------------------------
            | Old Image
            |--------------------------------------------------------------
            */

            $oldImageName =
                $heroSlide->image;


            /*
            |--------------------------------------------------------------
            | Update Information
            |--------------------------------------------------------------
            */

            $heroSlide->name =
                $request->name;

            $heroSlide->name_ar =
                $request->name_ar;

            $heroSlide->slug =
                $request->slug;

            $heroSlide->status =
                $request->status;


            $heroSlide->save();


            /*
            |--------------------------------------------------------------
            | New Image
            |--------------------------------------------------------------
            */

            if ($request->image_id > 0) {


                $tempImage =
                    TempFile::where(
                        'id',
                        $request->image_id
                    )->first();


                if ($tempImage) {


                    $tempFileName =
                        $tempImage->name;


                    $ext = pathinfo(
                        $tempFileName,
                        PATHINFO_EXTENSION
                    );


                    $newFileName =
                        $heroSlide->slug .
                        '.' .
                        $ext;


                    $sourcePath =
                        public_path(
                            'uploads/temp/' .
                            $tempFileName
                        );


                    $smallDirectory =
                        public_path(
                            'uploads/hero_slides/thumb/small'
                        );


                    $largeDirectory =
                        public_path(
                            'uploads/hero_slides/thumb/large'
                        );


                    /*
                    |------------------------------------------------------
                    | Create Directories
                    |------------------------------------------------------
                    */

                    if (
                        !File::exists(
                            $smallDirectory
                        )
                    ) {

                        File::makeDirectory(
                            $smallDirectory,
                            0755,
                            true
                        );

                    }


                    if (
                        !File::exists(
                            $largeDirectory
                        )
                    ) {

                        File::makeDirectory(
                            $largeDirectory,
                            0755,
                            true
                        );

                    }


                    if (
                        File::exists(
                            $sourcePath
                        )
                    ) {


                        $manager =
                            new ImageManager(
                                new Driver()
                            );


                        /*
                        |--------------------------------------------------
                        | Small Image
                        |--------------------------------------------------
                        */

                        $img =
                            $manager->decodePath(
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


                        /*
                        |--------------------------------------------------
                        | Large Image
                        |--------------------------------------------------
                        */

                        $img =
                            $manager->decodePath(
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


                        /*
                        |--------------------------------------------------
                        | Delete Old Image
                        |--------------------------------------------------
                        */

                        if (
                            !empty(
                                $oldImageName
                            )
                        ) {

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


                        /*
                        |--------------------------------------------------
                        | Save New Image
                        |--------------------------------------------------
                        */

                        $heroSlide->image =
                            $newFileName;


                        $heroSlide->save();


                        /*
                        |--------------------------------------------------
                        | Delete Temporary Image
                        |--------------------------------------------------
                        */

                        File::delete(
                            $sourcePath
                        );


                        $tempImage->delete();

                    }

                }

            }


            /*
            |--------------------------------------------------------------
            | Success Message
            |--------------------------------------------------------------
            */

            $request->session()->flash(
                'success',
                'Hero Slide Updated Successfully'
            );


            /*
            |--------------------------------------------------------------
            | IMPORTANT:
            | Return JSON because Edit uses AJAX
            |--------------------------------------------------------------
            */

            return response()->json(
                [
                    'status' => 200,

                    'message' =>
                        'Hero Slide Updated Successfully'
                ]
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Validation Errors
        |--------------------------------------------------------------------------
        */

        return response()->json(
            [
                'status' => 0,

                'errors' =>
                    $validator->errors()
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Hero Slide
    |--------------------------------------------------------------------------
    */

    public function delete(
        Request $request,
        $id
    ) {

        $heroSlide =
            HeroSlide::find($id);


        if (!$heroSlide) {

            $request->session()->flash(
                'error',
                'Record not found'
            );


            return response()->json(
                [
                    'status' => 0
                ]
            );

        }


        /*
        |--------------------------------------------------------------
        | Delete Images
        |--------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------
        | Delete Record
        |--------------------------------------------------------------
        */

        $heroSlide->delete();


        $request->session()->flash(
            'success',
            'Hero Slide deleted successfully'
        );


        return response()->json(
            [
                'status' => 1
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Slug
    |--------------------------------------------------------------------------
    */

    public function getSlug(
        Request $request
    ) {

        $slug =
            SlugService::createSlug(
                HeroSlide::class,
                'slug',
                $request->name
            );


        return response()->json(
            [
                'status' => true,

                'slug' => $slug
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Main Image
    |--------------------------------------------------------------------------
    */

    public function removeMainImage(
        Request $request,
        $id
    ) {

        $heroSlide =
            HeroSlide::findOrFail($id);


        $imageName =
            $request->input('image');


        if (
            $heroSlide->image === $imageName
        ) {


            $largeImagePath =
                public_path(
                    'uploads/hero_slides/thumb/large/' .
                    $imageName
                );


            $smallImagePath =
                public_path(
                    'uploads/hero_slides/thumb/small/' .
                    $imageName
                );


            /*
            |--------------------------------------------------------------
            | Delete Large Image
            |--------------------------------------------------------------
            */

            if (
                File::exists(
                    $largeImagePath
                )
            ) {

                File::delete(
                    $largeImagePath
                );

            }


            /*
            |--------------------------------------------------------------
            | Delete Small Image
            |--------------------------------------------------------------
            */

            if (
                File::exists(
                    $smallImagePath
                )
            ) {

                File::delete(
                    $smallImagePath
                );

            }


            /*
            |--------------------------------------------------------------
            | Remove Image From Database
            |--------------------------------------------------------------
            */

            $heroSlide->image = null;


            if (
                $heroSlide->save()
            ) {

                return response()->json(
                    [
                        'status' => 200,

                        'message' =>
                            'Main image removed successfully'
                    ]
                );

            }


            return response()->json(
                [
                    'status' => 500,

                    'message' =>
                        'Failed to remove image from database'
                ]
            );

        }


        return response()->json(
            [
                'status' => 400,

                'message' =>
                    'Image not found'
            ]
        );
    }
}
