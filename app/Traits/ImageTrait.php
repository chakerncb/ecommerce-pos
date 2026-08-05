<?php 

namespace App\Traits;

Trait ImageTrait {

   function saveImage($image_request, $image_path) {
      if ($image_request != null) {
         $file_extension = $image_request->getClientOriginalExtension();
         $file_name = time() . '_' . uniqid() . '.' . $file_extension;
         $path = $image_path;
         $image_request->move($path, $file_name);

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