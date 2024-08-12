<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait GlobalTrait
{
    /*  public $images_dir = (is_dir(public_path('../../public/imagesz/')))? '../../public/images/':'images/';
    public $temp_image_dir = $this->images_dir.'courses/temp/'; */

    public function getImagesDir()
    {
        return 'images/';
    }
    public function getTempImageDir()
    {
        return $this->getImagesDir() . 'courses/temp/';
    }

    /**
     * Summary of file_exists_get_new_name
     * This function will check if file exists in specified folder, if it exists, add number to the end of the file name, if the next name still exists, keep incrementing until it doesn't exist
     * @param string $dir
     * @param string $file_name
     * @return string
     */
    public function file_exists_get_new_name(string $dir, string $file_name)
    {
        $image_location = "$dir/$file_name";
        $new_image_name = $file_name;
        while (file_exists($image_location)) {
            Log::info('there is an image in temp folder with same name::' . $image_location);
            $location_array = explode('/', $image_location);
            $image_name = $location_array[count($location_array) - 1]; // dzb_00000_gimp_crop_image.jpg
            $name_array = explode('.', $image_name);
            $name = $name_array[0]; // dzb_00000_gimp_crop_image
            $extension = $name_array[count($name_array) - 1]; // jpg or png etc
            $last_index = strlen($name) - 1;
            $number_count = 0;
            while (is_numeric($name[$last_index])) {
                $number_count++;
                $last_index--;
            }
            if (!$number_count) {
                Log::info("------------No number found-------------");
                $new_image_name = $name_array[0] . '1.' . $extension;
            } else {
                $extracted_number = (int) substr($name, -$number_count) + 1;
                // change dzb_00000_image0.jpg to dzb_00000_image1.jpg
                $new_image_name = substr($name, 0, -strlen($extracted_number)) . "$extracted_number.$extension";
            }

            $image_location = str_replace($image_name, $new_image_name, $image_location);
            Log::info("::Image Name=>$image_location");
        }
        return $new_image_name;
    }

    /**
     * is_local
     * @return bool
     * @param Request $request
     */
    public function is_local(Request $request): bool
    {
        return !str_contains($request->url(), '.com/');
    }
}
