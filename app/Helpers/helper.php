<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

function uploadImage($file, $folder, $width = 512, $height = 512)
{
    if ($file) {
        $name = time() . '.' . $file->extension();
        $image = ImageManager::read($file->getRealPath());
        $image->resize($width, $height);

        Storage::disk('public')->put("admin/{$folder}" . $name, (string)$image->encode($file->extension(), 90));
        return $name;
    } else {
        return false;
    }
}

function deleteImage($path)
{
    if (Storage::exists($path)) {
        Storage::delete($path);
    }
}
