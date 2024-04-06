<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return mixed
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
