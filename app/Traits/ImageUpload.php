<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function UserImageUpload($image, $oldImage = NULL)
    {
        $imageFile = $image->getClientOriginalName();
        $filename = pathinfo($imageFile, PATHINFO_FILENAME);
        $extension = pathinfo($imageFile, PATHINFO_EXTENSION);
        $imageName = $filename . "-" . time() . "." . $extension;
        $image->storeAs("images", $imageName, "public");
        if ($oldImage) {
            $path = str_replace('storage', '/public', $oldImage);
            Storage::delete($path);
        }
        $path = 'storage/images/' . $imageName;
        return $path;
    }
}
