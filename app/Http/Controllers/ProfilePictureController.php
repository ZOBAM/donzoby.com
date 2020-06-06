<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile_picture;

class ProfilePictureController extends Controller
{
    //
    public function index(Request $request)
    {
    if ($request->hasFile('file')){
    	$response = "Has file<br>";
 		$image = $request->file('file');
			$imageName = $image->getClientOriginalName();
		$imagePath='images/profile/'.$imageName;

		if ($image->move(public_path('images/profile/'), $imageName)) {
		$response = $response."File moved<br>";
		$db_images = Profile_picture::where('user_id', Auth::id())->get();//get images saved in db

		if (count($db_images)>0) {/*there are images in db for this post*/
			$response = $response."Has image in db<br>";
			foreach ($db_images as $value) {
				$response = $response."image: $value->link <br>";
				if(file_exists(public_path($value->link))){//image re-uploaded with same name
				$response = $response."File exist in dir<br>";
               	unlink(public_path($value->link));

               	$new_post_image = Profile_picture::find($value->id);
               	$new_post_image->link = $imagePath;
               	$new_post_image->save();
            	}
            	else{
            		$new_post_image = Profile_picture::find($value->id);
	               	$new_post_image->link = $imagePath;
	               	$new_post_image->save();
            	}
           	}//endforeach

           return json_encode(['location' => $response ]);
		}
		else{
			$response = $response." No image in db<br>";
			$Profile_picture = new Profile_picture;
			$Profile_picture->link = $imagePath;
			$Profile_picture->user_id = Auth::id();
            $Profile_picture->save();

   			return json_encode(['location' => $response ]);
			}
		}
		else{
			return json_encode(['location' => "Sorry, Couldn't Save uploaded file." ]);
		}
	}
	else{
	return json_encode(['location' => URL('images/dzb-graphics.png') ]);
	}
 }//end index
}
