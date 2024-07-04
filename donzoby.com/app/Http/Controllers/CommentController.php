<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'min:3', 'max:1600'],
            'post_id' => ['required', 'numeric', 'exists:posts,id',],
        ]);

        $post = Post::find($validated['post_id']);
        // only proceed if post's comment status is open
        if ($post->comment_status == 'closed') {
            return response()->json([
                'status' => 'error',
                'message' => 'This post does not accept comments at the moment.',
            ], 422);
        }
        $validated['user_id'] = Auth::id();
        $comment = $post->comments()->create($validated);
        $comment->user;

        return response()->json([
            'status' => 'success',
            'message' => 'Comment submitted',
            'data' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'min:3', 'max:1600'],
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validated);
        $comment->user;

        return response()->json([
            'status' => 'success',
            'message' => 'comment successfully updated',
            'data' => $comment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $request->merge(['id' => $id]);
        $validated = $request->validate([
            'id' => ['required', 'string', 'exists:comments,id',],
        ]);
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Comment successfully deleted',
        ]);
    }
}
