<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostPictureController extends Controller
{
    //
    public function index(Request $request)
    {
    	if ($request->hasFile('file')){
     		$image = $request->file('file');
   			$imageName = "dzb_00000_".str_replace(" ","-",$image->getClientOriginalName());
    		$imagePath=URL('images/courses/temp/'.$imageName);
            $images_path = 'images/courses/temp/' ;
            // $images_path = (is_dir(public_path('../../public/images/')))? '../../public/images/':'images/' ;
            /* if(is_dir(public_path('../../public/images/'))){
                return ['location' => "(is_dir(public_path('../../public/images/')) is true"];
            } */
    		$image->move($images_path, $imageName);
    		//$path = $request->file->store('images','public');
            Log::info(public_path($images_path));
            return json_encode(['location' => $imagePath, 'move_path' => public_path($images_path)]);
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
else{
   return json_encode(['location' => URL('images/dzb-graphics.png') ]);
} */
