<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

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

            $image_location = str_replace($image_name, $new_image_name, $image_location);
            Log::info("::Image Name=>$image_location");
        }
        return $new_image_name;
    }
}
