<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\TempFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $reviews = $query->paginate(20);

        return view('admin.reviews.list', ['reviews' => $reviews]);
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'review_date' => 'nullable|date',
            'status' => 'required|boolean',
            'image_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ], 422);
        }

        $review = new Review();
        $review->name = $request->name;
        $review->slug = $request->slug;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->review_date = $request->review_date;
        $review->status = $request->status;
        $review->save();

        if (!empty($request->image_id)) {
            $tempImage = TempFile::find($request->image_id);

            if ($tempImage) {
                $tempFileName = $tempImage->name;
                $ext = pathinfo($tempFileName, PATHINFO_EXTENSION);
                $newFileName = $review->slug . '.' . $ext;
                $sourcePath = public_path('uploads/temp/' . $tempFileName);
                $smallDirectory = public_path('uploads/reviews/thumb/small');
                $largeDirectory = public_path('uploads/reviews/thumb/large');

                if (!File::exists($smallDirectory)) {
                    File::makeDirectory($smallDirectory, 0755, true);
                }

                if (!File::exists($largeDirectory)) {
                    File::makeDirectory($largeDirectory, 0755, true);
                }

                if (File::exists($sourcePath)) {
                    $manager = new ImageManager(new Driver());

                    $img = $manager->decodePath($sourcePath);
                    $img->cover(360, 220);
                    $img->save($smallDirectory . DIRECTORY_SEPARATOR . $newFileName);

                    $img = $manager->decodePath($sourcePath);
                    $img->scaleDown(width: 1150);
                    $img->save($largeDirectory . DIRECTORY_SEPARATOR . $newFileName);

                    $review->image = $newFileName;
                    $review->save();

                    File::delete($sourcePath);
                    $tempImage->delete();
                }
            }
        }

        $request->session()->flash('success', 'Review Created Successfully');

        return response()->json([
            'status' => 200,
            'message' => 'Review Created Successfully'
        ]);
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        return view('admin.reviews.edit', ['review' => $review]);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:reviews,name,' . $review->id,
            'slug' => 'required|unique:reviews,slug,' . $review->id,
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'review_date' => 'nullable|date',
            'status' => 'required|boolean',
            'image_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ], 422);
        }

        $oldImageName = $review->image;

        $review->name = $request->name;
        $review->slug = $request->slug;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->review_date = $request->review_date;
        $review->status = $request->status;
        $review->save();

        if (!empty($request->image_id)) {
            $tempImage = TempFile::find($request->image_id);

            if ($tempImage) {
                $tempFileName = $tempImage->name;
                $ext = pathinfo($tempFileName, PATHINFO_EXTENSION);
                $newFileName = $review->slug . '.' . $ext;
                $sourcePath = public_path('uploads/temp/' . $tempFileName);
                $smallDirectory = public_path('uploads/reviews/thumb/small');
                $largeDirectory = public_path('uploads/reviews/thumb/large');

                if (!File::exists($smallDirectory)) {
                    File::makeDirectory($smallDirectory, 0755, true);
                }

                if (!File::exists($largeDirectory)) {
                    File::makeDirectory($largeDirectory, 0755, true);
                }

                if (File::exists($sourcePath)) {
                    $manager = new ImageManager(new Driver());

                    $img = $manager->decodePath($sourcePath);
                    $img->cover(360, 220);
                    $img->save($smallDirectory . DIRECTORY_SEPARATOR . $newFileName);

                    $img = $manager->decodePath($sourcePath);
                    $img->scaleDown(width: 1150);
                    $img->save($largeDirectory . DIRECTORY_SEPARATOR . $newFileName);

                    if (!empty($oldImageName)) {
                        File::delete($smallDirectory . DIRECTORY_SEPARATOR . $oldImageName);
                        File::delete($largeDirectory . DIRECTORY_SEPARATOR . $oldImageName);
                    }

                    $review->image = $newFileName;
                    $review->save();

                    File::delete($sourcePath);
                    $tempImage->delete();
                }
            }
        }

        $request->session()->flash('success', 'Review Updated Successfully');

        return response()->json([
            'status' => 200,
            'message' => 'Review Updated Successfully'
        ]);
    }

    public function delete(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            $request->session()->flash('error', 'Record not found');

            return response([
                'status' => 0
            ]);
        }

        if ($review->image) {
            File::delete(public_path('uploads/reviews/thumb/small/' . $review->image));
            File::delete(public_path('uploads/reviews/thumb/large/' . $review->image));
        }

        $review->delete();

        $request->session()->flash('success', 'Review deleted successfully');

        return response([
            'status' => 1
        ]);
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(Review::class, 'slug', $request->name);

        return response()->json([
            'status' => true,
            'slug' => $slug,
        ]);
    }

    public function removeMainImage(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $imageName = $request->input('image');

        if ($review->image === $imageName) {
            $largeImagePath = public_path('uploads/reviews/thumb/large/' . $imageName);
            $smallImagePath = public_path('uploads/reviews/thumb/small/' . $imageName);

            if (file_exists($largeImagePath)) {
                unlink($largeImagePath);
            }

            if (file_exists($smallImagePath)) {
                unlink($smallImagePath);
            }

            $review->image = null;

            if ($review->save()) {
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
