<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Post;
use App\Comment;
use App\User;

class CommentController extends Controller
{
	public function __construct()
        {
            $this->middleware('auth');
        }


    public function store(Request $request, $post_id)
    {
        //
        $this->validate($request, [
            'comment_content' => 'required|min:7|max:1600',
        ]);
        
            $Comment = new Comment;
            $Comment->comment_content = $request->comment_content;
            $Comment->comment_post_id = $post_id;
            $Comment->user_id = Auth::id();
            
            $Comment->save();            
            

            return back();
    }//end store

    public function edit(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $comment = Comment::where('id', $id)->where('user_id', $user->id)->first();
        $edit_comment = $comment->comment_content;
        if($comment){
        	//return redirect('/post');
        	return back()->with('comment_content',$edit_comment);
        }
        else{
        	return redirect('/');
        }
    }//end edit

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'comment_content' => 'required|min:7|max:1600',
        ]);

        //$user = User::find(Auth::id());
        $comment = Comment::find($id);
        if($comment){
        	        //return redirect('/');

        	$comment->comment_content = $request->comment_content;
        	$comment->save();
        	return back()->with('comment_update_success',true);
        }
        else{
        	//return back()->with('comment_update_success',false);
        	return redirect('/web-design')->with('comment_update',$id);
        }
    }//end update

    public function destroy($id)
    {
        //
        $user = User::find(Auth::id());
        $deletedRows = Comment::where('id', $id)->where('user_id', $user->id)->delete();
        if($deletedRows){           
        return back()->with('comment_delete_success',true);
        }
        else{
        	return back()->with('comment_delete_success',false);
        }
    }//end destroy
}
