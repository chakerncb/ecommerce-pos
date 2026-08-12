<?php 

namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

trait ImageTrait {

   function saveImage($image_request, $image_path, $quality = 80) {
      if ($image_request != null) {
         $file_name = time() . '_' . uniqid() . '.webp';

         if (!File::exists($image_path)) {
            File::makeDirectory($image_path, 0755, true, true);
         }

         $full_path = rtrim($image_path, '/') . '/' . $file_name;

         try {
            $manager = new ImageManager(new Driver());
            $image = $manager->decodePath($image_request->getRealPath());
            $encoded = $image->encodeUsingFileExtension('webp', quality: $quality);
            $encoded->save($full_path);
         } catch (\Throwable $e) {
            $file_extension = $image_request->getClientOriginalExtension();
            $file_name = time() . '_' . uniqid() . '.' . $file_extension;
            $image_request->move($image_path, $file_name);
         }

         return $file_name;
      } else {
         return 'no-image.png';
      }
   }

   function deleteImage($image_path) {
      if (file_exists($image_path)) {
         unlink($image_path);
      }
   }
}