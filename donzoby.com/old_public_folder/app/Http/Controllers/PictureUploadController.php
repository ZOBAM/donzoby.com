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
   			$imageName = str_replace(" ","-",$image->getClientOriginalName());
    		$imagePath=URL('public/images/courses/'.$imageName);
    		$image->move(public_path('images/courses/'), $imageName);
    		//$path = $request->file->store('images','public');
   return json_encode(['location' => $imagePath ]);
}
else{
	return json_encode(['location' => URL('public/images/dzb-graphics.png') ]);
}
}//end index

}
