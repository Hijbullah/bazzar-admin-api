<?php
  
namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait ImageUpload {
    
    public function uploadImage($file, $pathFolder, $width = 200, $height = null)
    {
        $path = $pathFolder . '/' . Str::random(30) . '-' . time() . '.' . $file->getClientOriginalExtension();

        $image = Image::make($file->getRealPath())->encode('jpg', 65)->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->stream();

        Storage::put($path, $image);
        
        return $path;
    }

    public function deleteImage($path) 
    {
        Storage::delete($path);
        return true;
    } 
}