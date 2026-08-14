<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Service;
use App\Models\TempFile;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::select(
            'services.*',
            'categories.name as categoryName',
            'sub_categories.name as subCategoryName'
        )
        ->leftJoin('categories', 'categories.id', '=', 'services.category_id')
        ->leftJoin('sub_categories', 'sub_categories.id', '=', 'services.sub_category_id');

        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('services.name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('categories.name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('sub_categories.name', 'like', '%' . $request->keyword . '%');
            });
        }

        if (!empty($request->category)) {
            $query->where('services.category_id', $request->category);
        }

        if (!empty($request->sub_category)) {
            $query->where('services.sub_category_id', $request->sub_category);
        }

        $services = $query->latest('services.id')->paginate(20);

        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = SubCategory::orderBy('name', 'ASC')->get();

        return view('admin.services.list', [
            'services' => $services,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = SubCategory::orderBy('name', 'ASC')->get();

        return view('admin.services.create', [
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services,name',
            'slug' => 'required|unique:services,slug',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'nullable|exists:sub_categories,id',
            'videos_link' => 'nullable|url',
            'additional_videos_links' => 'nullable|array',
            'additional_videos_links.*' => 'nullable|url',
            'status' => 'required|in:0,1',
            'image_id' => 'nullable|integer',
            'gallery_images' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
            ], 422);
        }

        $service = new Service();

        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->category_id = $request->category;
        $service->sub_category_id = $request->sub_category ?: null;
        $service->description = $request->description;
        $service->short_desc = $request->short_description;
        $service->meta_title = $request->meta_title ?: $request->name . ' | Marhaba Ai';
        $service->meta_description = $request->meta_description ?: 'EXPLORE ' . $request->name . ' FROM Marhaba Ai, PROVIDING TOP EVENT SERVICES IN DUBAI.';
        $service->meta_keywords = $request->meta_keywords ?: 'Marhaba Ai, ' . $request->name . ', DUBAI, UAE';
        $service->videos_link = $request->videos_link;

        $service->additional_videos_links = json_encode(
            array_values(
                array_filter(
                    $request->input('additional_videos_links', [])
                )
            )
        );

        $service->status = $request->status;
        $service->image_alt_text = $request->image_alt_text ?: $request->name . ' | Marhaba Ai';

        $service->save();

        if ($request->filled('image_id') && $request->image_id > 0) {
            $tempImage = TempFile::find($request->image_id);

            if ($tempImage) {
                $sourcePath = public_path('uploads/temp/' . $tempImage->name);

                if (file_exists($sourcePath)) {
                    $extension = pathinfo($tempImage->name, PATHINFO_EXTENSION);
                    $newFileName = $service->slug . '.' . $extension;

                    $smallPath = public_path(
                        'uploads/services/thumb/small/' . $newFileName
                    );

                    $largePath = public_path(
                        'uploads/services/thumb/large/' . $newFileName
                    );

                    $this->makeDirectory(dirname($smallPath));
                    $this->makeDirectory(dirname($largePath));

                    $manager = ImageManager::usingDriver(Driver::class);

                    $img = $manager->decodePath($sourcePath);
                    $img->cover(360, 220);
                    $img->save($smallPath);

                    $img = $manager->decodePath($sourcePath);
                    $img->scaleDown(1150);
                    $img->save($largePath);

                    $service->image = $newFileName;
                    $service->save();

                    File::delete($sourcePath);
                    $tempImage->delete();
                }
            }
        }

        if ($request->filled('gallery_images')) {
            $galleryImageIds = array_filter(
                explode(',', $request->gallery_images)
            );

            $galleryImagePaths = [];
            $counter = 1;

            foreach ($galleryImageIds as $imageId) {
                $tempImage = TempFile::find($imageId);

                if (!$tempImage) {
                    continue;
                }

                $sourcePath = public_path(
                    'uploads/temp/' . $tempImage->name
                );

                if (!file_exists($sourcePath)) {
                    continue;
                }

                $extension = pathinfo(
                    $tempImage->name,
                    PATHINFO_EXTENSION
                );

                $newFileName = $service->slug . '-' . $counter . '.' . $extension;

                $destinationPath = public_path(
                    'uploads/services/gallery/' . $newFileName
                );

                $this->makeDirectory(dirname($destinationPath));

                $manager = ImageManager::usingDriver(Driver::class);

                $img = $manager->decodePath($sourcePath);
                $img->save($destinationPath);

                $galleryImagePaths[] = $newFileName;

                File::delete($sourcePath);
                $tempImage->delete();

                $counter++;
            }

            $service->gallery_images = json_encode($galleryImagePaths);
            $service->save();
        }

        $request->session()->flash(
            'success',
            'Service Created Successfully'
        );

        return response()->json([
            'status' => 200,
            'message' => 'Service Created Successfully',
        ]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        $categories = Category::orderBy('name', 'ASC')->get();

        $sub_categories = SubCategory::where(
            'category_id',
            $service->category_id
        )
        ->orderBy('name', 'ASC')
        ->get();

        $additional_videos_links = [];

        if (!empty($service->additional_videos_links)) {
            if (is_string($service->additional_videos_links)) {
                $additional_videos_links = json_decode(
                    $service->additional_videos_links,
                    true
                ) ?: [];
            } elseif (is_array($service->additional_videos_links)) {
                $additional_videos_links = $service->additional_videos_links;
            }
        }

        return view('admin.services.edit', [
            'service' => $service,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'additional_videos_links' => $additional_videos_links,
        ]);
    }

    public function update($id, Request $request)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'status' => 0,
                'message' => 'Record not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services,name,' . $service->id,
            'slug' => 'required|unique:services,slug,' . $service->id,
            'category' => 'required|exists:categories,id',
            'sub_category' => 'nullable|exists:sub_categories,id',
            'videos_link' => 'nullable|url',
            'additional_videos_links' => 'nullable|array',
            'additional_videos_links.*' => 'nullable|url',
            'status' => 'required|in:0,1',
            'image_id' => 'nullable|integer',
            'gallery_images' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
            ], 422);
        }

        $oldImageName = $service->image;

        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->category_id = $request->category;
        $service->sub_category_id = $request->sub_category ?: null;
        $service->description = $request->description;
        $service->short_desc = $request->short_description;
        $service->meta_title = $request->meta_title ?: $request->name . ' | Marhaba Ai';
        $service->meta_description = $request->meta_description ?: 'EXPLORE ' . $request->name . ' FROM Marhaba Ai, PROVIDING TOP EVENT SERVICES IN DUBAI.';
        $service->meta_keywords = $request->meta_keywords ?: 'Marhaba Ai, EVENT SERVICES, ' . $request->name . ', DUBAI, UAE';
        $service->videos_link = $request->videos_link;

        $service->additional_videos_links = json_encode(
            array_values(
                array_filter(
                    $request->input('additional_videos_links', [])
                )
            )
        );

        $service->status = $request->status;
        $service->image_alt_text = $request->image_alt_text ?: $request->name . ' | Marhaba Ai';

        $service->save();

        if ($request->filled('image_id') && $request->image_id > 0) {
            $tempImage = TempFile::find($request->image_id);

            if ($tempImage) {
                $sourcePath = public_path(
                    'uploads/temp/' . $tempImage->name
                );

                if (file_exists($sourcePath)) {
                    $extension = pathinfo(
                        $tempImage->name,
                        PATHINFO_EXTENSION
                    );

                    $newFileName = $service->slug . '.' . $extension;

                    $smallPath = public_path(
                        'uploads/services/thumb/small/' . $newFileName
                    );

                    $largePath = public_path(
                        'uploads/services/thumb/large/' . $newFileName
                    );

                    $this->makeDirectory(dirname($smallPath));
                    $this->makeDirectory(dirname($largePath));

                    $manager = ImageManager::usingDriver(Driver::class);

                    $img = $manager->decodePath($sourcePath);
                    $img->cover(360, 220);
                    $img->save($smallPath);

                    $img = $manager->decodePath($sourcePath);
                    $img->scaleDown(1150);
                    $img->save($largePath);

                    if ($oldImageName) {
                        File::delete(
                            public_path(
                                'uploads/services/thumb/small/' . $oldImageName
                            )
                        );

                        File::delete(
                            public_path(
                                'uploads/services/thumb/large/' . $oldImageName
                            )
                        );
                    }

                    $service->image = $newFileName;
                    $service->save();

                    File::delete($sourcePath);
                    $tempImage->delete();
                }
            }
        }

        if ($request->filled('gallery_images')) {
            $galleryImageIds = array_filter(
                explode(',', $request->gallery_images)
            );

            $existing = [];

            if (!empty($service->gallery_images)) {
                $existing = json_decode(
                    $service->gallery_images,
                    true
                ) ?: [];
            }

            $galleryImagePaths = $existing;
            $counter = count($existing) + 1;

            foreach ($galleryImageIds as $imageId) {
                $tempImage = TempFile::find($imageId);

                if (!$tempImage) {
                    continue;
                }

                $sourcePath = public_path(
                    'uploads/temp/' . $tempImage->name
                );

                if (!file_exists($sourcePath)) {
                    continue;
                }

                $extension = pathinfo(
                    $tempImage->name,
                    PATHINFO_EXTENSION
                );

                $newFileName = $service->slug . '-' . $counter . '.' . $extension;

                $destinationPath = public_path(
                    'uploads/services/gallery/' . $newFileName
                );

                $this->makeDirectory(dirname($destinationPath));

                $manager = ImageManager::usingDriver(Driver::class);

                $img = $manager->decodePath($sourcePath);
                $img->save($destinationPath);

                $galleryImagePaths[] = $newFileName;

                File::delete($sourcePath);
                $tempImage->delete();

                $counter++;
            }

            $service->gallery_images = json_encode(
                array_values($galleryImagePaths)
            );

            $service->save();
        }

        $request->session()->flash(
            'success',
            'Service updated Successfully'
        );

        return response()->json([
            'status' => 200,
            'message' => 'Service updated Successfully',
            'redirect' => route('serviceList'),
        ]);
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where(
            'category_id',
            $request->category_id
        )
        ->orderBy('name', 'ASC')
        ->get([
            'id',
            'name',
        ]);

        return response()->json([
            'status' => true,
            'subCategories' => $subCategories,
        ]);
    }

    public function removeMainImage(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $imageName = $request->input('image');

        if ($service->image !== $imageName) {
            return response()->json([
                'status' => 400,
                'message' => 'Image not found',
            ]);
        }

        $largeImagePath = public_path(
            'uploads/services/thumb/large/' . $imageName
        );

        $smallImagePath = public_path(
            'uploads/services/thumb/small/' . $imageName
        );

        if (file_exists($largeImagePath)) {
            unlink($largeImagePath);
        }

        if (file_exists($smallImagePath)) {
            unlink($smallImagePath);
        }

        $service->image = null;
        $service->save();

        return response()->json([
            'status' => 200,
            'message' => 'Main image removed successfully',
        ]);
    }

    public function removeGalleryImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'status' => 404,
                'message' => 'Service not found.',
            ]);
        }

        $image = $request->input('image');

        $galleryImages = json_decode(
            $service->gallery_images,
            true
        ) ?: [];

        $key = array_search($image, $galleryImages);

        if ($key === false) {
            return response()->json([
                'status' => 400,
                'message' => 'Image not found in gallery.',
            ]);
        }

        unset($galleryImages[$key]);

        $service->gallery_images = json_encode(
            array_values($galleryImages)
        );

        $service->save();

        $filePath = public_path(
            'uploads/services/gallery/' . $image
        );

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Image removed successfully.',
        ]);
    }

    public function delete($id, Request $request)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'status' => 0,
                'message' => 'Record not found',
            ]);
        }

        if ($service->image) {
            File::delete(
                public_path(
                    'uploads/services/thumb/small/' . $service->image
                )
            );

            File::delete(
                public_path(
                    'uploads/services/thumb/large/' . $service->image
                )
            );
        }

        if ($service->gallery_images) {
            $galleryImages = json_decode(
                $service->gallery_images,
                true
            ) ?: [];

            foreach ($galleryImages as $image) {
                File::delete(
                    public_path(
                        'uploads/services/gallery/' . $image
                    )
                );
            }
        }

        $service->delete();

        $request->session()->flash(
            'success',
            'Service deleted successfully.'
        );

        return response()->json([
            'status' => 1,
        ]);
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Service::class,
            'slug',
            $request->name
        );

        return response()->json([
            'status' => true,
            'slug' => $slug,
        ]);
    }

    private function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}
