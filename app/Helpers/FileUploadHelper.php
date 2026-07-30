<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadHelper
{
    public static function uploadFile(Request $request, $storagePath = 'avatars', $fileName = null)
    {
        //dd($fileName);
        if ($request->hasFile($fileName )) {
            $request->validate([
                $fileName => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $file = $request->file($fileName);
            //dd($file);
            // Generate a unique, random name if $fileName is not provided
            $image_name = $file->hashName();
            // Store the file with the dynamic name and path
            $path = $file->storePublicly($storagePath, 'public');

            return $image_name; // You can customize the return value as needed
        }

        return null; // No file uploaded
    }
}
