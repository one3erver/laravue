<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

function uploadImage($file, $folder, $width = 512, $height = 512)
{
    if ($file) {
        $name = time() . '.' . $file->extension();
        $image = (new ImageManager(new Driver()))->read($file->getRealPath());
        $image->resize($width, $height);

        Storage::disk('local')->put("admin/{$folder}/" . $name, $image->encode());
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
