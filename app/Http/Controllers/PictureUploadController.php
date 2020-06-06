<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PictureUploadController extends Controller
{
    //
    public function index(Request $request)
    {
    	if ($request->hasFile('file')){
     		$image = $request->file('file');
   			$imageName = "dzb_00000_".str_replace(" ","-",$image->getClientOriginalName());
    		$imagePath=URL('images/courses/'.$imageName);
            $move_path = (is_dir(public_path('../../public/images/')))? public_path('../../public/images/courses/'):'images/courses/' ;
            /* if(is_dir(public_path('../../public/images/'))){
                return ['location' => "(is_dir(public_path('../../public/images/')) is true"];
            } */
    		$image->move($move_path, $imageName);
    		//$path = $request->file->store('images','public');
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
else{
   return json_encode(['location' => URL('images/dzb-graphics.png') ]);
} */
