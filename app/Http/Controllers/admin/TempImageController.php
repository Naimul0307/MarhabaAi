<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempFile;

class TempImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png,gif,webp,avif|max:10240',
        ]);

        $image = $request->file('file');

        $destinationPath = public_path('uploads/temp');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $extension = strtolower($image->getClientOriginalExtension());
        $newFileName = uniqid('', true) . '.' . $extension;

        $image->move($destinationPath, $newFileName);

        $temp = new TempFile();
        $temp->name = $newFileName;
        $temp->save();

        return response()->json([
            'status' => 200,
            'id' => $temp->id,
            'name' => $newFileName,
        ]);
    }

    public function uploadGalleryImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png,gif,webp,avif|max:10240',
        ]);

        $image = $request->file('file');

        $destinationPath = public_path('uploads/temp');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $extension = strtolower($image->getClientOriginalExtension());
        $newFileName = uniqid('', true) . '.' . $extension;

        $image->move($destinationPath, $newFileName);

        $temp = new TempFile();
        $temp->name = $newFileName;
        $temp->save();

        return response()->json([
            'status' => 200,
            'id' => $temp->id,
            'name' => $newFileName,
        ]);
    }
}
