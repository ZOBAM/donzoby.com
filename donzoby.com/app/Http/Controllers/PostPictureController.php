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

    	if ($request->hasFile('file')){
     		$image = $request->file('file');
   			$imageName = "dzb_00000_".str_replace(" ","-",$image->getClientOriginalName());
    		$imagePath=URL($this->getTempImageDir() . $imageName);

    		$image->move($this->getTempImageDir(), $imageName);

            return json_encode(['location' => $imagePath]);
        }
        else{
            return json_encode(['location' => URL('images/dzb-graphics.png') ]);
        }
    }//end index

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
