<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Post;
use App\Comment;
use App\User;

class CommentController extends Controller
{
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
        if($comment){
        	return back()->with('comment_content',$comment->comment_content);
        }
        else{
        	return back()->with('comment_edit_success',false);
        }
    }//end edit

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'comment_content' => 'required|min:7|max:1600',
        ]);

        $user = User::find(Auth::id());
        $comment = Comment::where('id', $id)->where('user_id', $user->id)->first();
        if($comment){
        	$comment->comment_content = $request->comment_content;
        	$comment->save();
        	return back()->with('comment_edit_success',true);
        }
        else{
        	return back()->with('comment_edit_success',false);
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
