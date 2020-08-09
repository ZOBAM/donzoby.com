<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Profile_picture;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($item=1,$action=2)
    {
        if ($item=="profile" && $action=="view") {//display profile details
            $view = "profile";
            return view('member',compact('view'));
        }
        if ($item=="create" && $action=="create-data-plan") {//create data plans
            $approved_emails = ['upc4you@gmail.com', 'giftibe04@gmail.com'];
            if(!in_array(Auth::user()->email, $approved_emails)){
                return redirect()->back();
            }
            $view = "create-data-plan";
            return view('member',compact('view'));
        }
        else if ($item=="profile" && $action=="edit") {//edit profile
            $view = "edit_profile";
            $user_data = User::find(Auth::id());
            return view('member', compact('view'));
        }
        else if ($item=="profile" && $action=="change-picture") {//edit profile
            $view = "change_picture";
            $user_data = User::find(Auth::id());
            return view('member', compact('view','user_data'));
        }
        else {//
            $view = "profile";
            return view('member',compact('view'));
        }
    }
}
