<?php

namespace App\Common\Utility\Files;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image
{
    public static function storeImage($image, string $name = '', string $file_path = '') : string
    {
        $upload_path = '';
        if(!empty($image) && $image->isValid()){
            $name = !empty($name) ? $name : $image->getClientOriginalName().Str::random(8).time();
            $name = $name.".".$image->getClientOriginalExtension();
            $path = !empty($file_path) ? $file_path :  'common';
            $upload_path =  $image->storeAs($path, $name, 'public');
        }
        return $upload_path;
    }
    public static function deleteImage($image_path)
    {
        if (!empty($image_path) && Storage::disk('public')->exists($image_path)) {
            Storage::disk('public')->delete($image_path);
        }
    }
}
