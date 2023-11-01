<?php

namespace App\Helpers;

use App\Models\VehicleDocument;
use App\Models\VehicleImage;
use Illuminate\Support\Facades\File;

class ImageUploadHelper
{
    public static function imageUpload( $files ,$folder): string
    {
        $image_path = $folder;
//        date('Y') . '/' . date('m')
        if (!File::exists(public_path() . "/" . $image_path)) {
            File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
        }
//        $extension = $files->getClientOriginalExtension();
        $image_name = $files->getClientOriginalName();
        $destination_path = public_path() . '/' . $image_path;
        $file_name = uniqid() . '-' . $image_name;
        $files->move($destination_path, $file_name);
        return $image_path . '/' . $file_name;
    }

    public static function deleteImage( $files ): bool
    {
        if(file_exists(public_path() . "/" . $files)){
            @unlink(public_path() . "/" . $files);
        }
        return true;
    }
    public static function deleteDocument( $files ): bool
    {
        if(file_exists(public_path() . "/" . $files)){
            @unlink(public_path() . "/" . $files);
        }
        return true;
    }

    public static function UploadMultipleImage($images, $id)
    {
        foreach ($images as $val) {
            $image = new VehicleImage();
            $image->vehicle_id = $id;
            $image->image = $val->name;
            $image->save();
        }
    }
    public static function UploadMultipleDocument($images, $id)
    {
        foreach ($images as $val) {
            $image = new VehicleDocument();
            $image->vehicle_id = $id;
            $image->document = $val->name;
            $image->save();
        }
    }
}
