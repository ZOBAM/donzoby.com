<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait GlobalTrait{
   /*  public $images_dir = (is_dir(public_path('../../public/imagesz/')))? '../../public/images/':'images/';
    public $temp_image_dir = $this->images_dir.'courses/temp/'; */

    public function getImagesDir(){
        return 'images/';
    }
    public function getTempImageDir(){
        return $this->getImagesDir().'courses/temp/';
    }
}