<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

function uploadImage($file, $folder, $width = null, $height = null)
{
    if ($file) {
        $name = time() . '.' . $file->extension();
        $image = (new ImageManager(new Driver()))->read($file->getRealPath());
        if (isset($width) && isset($height)) {
            $image->resize($width, $height);
        }

        Storage::disk('local')->put("admin/{$folder}/" . $name, $image->encode());
        return $name;
    } else {
        return false;
    }
}

function deleteImage($path)
{
    if (Storage::disk('local')->exists($path)) {
        Storage::disk('local')->delete($path);
    }
}
