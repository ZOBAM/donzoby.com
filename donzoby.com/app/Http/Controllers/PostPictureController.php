<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post_image;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostPictureController extends Controller
{
    use GlobalTrait;

    public function index(Request $request)
    {

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = "dzb_00000_" . str_replace(" ", "-", $image->getClientOriginalName());
            // allow author to post two images of same name
            // this will also solve the blob multiple images issue
            $image_location = $this->getTempImageDir() . $this->file_exists_get_new_name($this->getTempImageDir(), $imageName); // courses/temp/dzb_00000_gimp_crop_image.jpg
            /* while (file_exists($image_location)) {
                Log::info('there is an image in temp folder with same name::' . $image_location);
                $location_array = explode('/', $image_location);
                $image_name = $location_array[count($location_array) - 1]; // dzb_00000_gimp_crop_image.jpg
                $name_array = explode('.', $image_name);
                $name = $name_array[0]; // dzb_00000_gimp_crop_image
                $last_index = strlen($name) - 1;
                $number_count = 0;
                while (is_numeric($name[$last_index])) {
                    $number_count++;
                    $last_index--;
                }
                if (!$number_count) {
                    Log::info("------------No number found-------------");
                    $extracted_number = null;
                    $new_image_name = $name_array[0] . '1.' . $name_array[1];
                } else {
                    $extracted_number = (int) substr($name, -$number_count);
                    $new_image_name = str_replace($extracted_number, $extracted_number + 1, $image_name);
                }

                $imageName = $new_image_name;
                $image_location = str_replace($image_name, $new_image_name, $image_location);
                Log::info("::Image Name=>$image_location");
            } */

            $imagePath = URL($image_location);

            $image->move($this->getTempImageDir(), $imageName);

            return json_encode(['location' => $imagePath]);
        } else {
            return json_encode(['location' => URL('images/dzb-graphics.png')]);
        }
    } //end index

}
/* if ($request->hasFile('file')){
    $image = $request->file('file');
      $imageName = "dzb_00000_".str_replace(" ","-",$image->getClientOriginalName());
   $imagePath=URL('images/courses/'.$imageName);
   //../../images for local dev and images/ for production
   $images_path = (is_dir(public_path('../../public/images/')))? '../../public/images/':'images/' ;
   $image->move(public_path($images_path.'courses/', $imageName));
   return json_encode(['location' => $imagePath ]);
}
*/
