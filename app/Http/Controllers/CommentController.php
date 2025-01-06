<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $blogId)
    {
 
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        if ($request->has('parent_id')) {      
            $parentComment = Comment::find($request->parent_id);
            if ($parentComment) {
                $comment = new Comment();
                $comment->content = $validated['content'];
                $comment->user_id = Auth::id();
                $comment->blog_id = $blogId;
                $comment->parent_id = $request->parent_id; 
                $comment->save();
            }
        } else {
            $comment = new Comment();
            $comment->content = $validated['content'];
            $comment->user_id = Auth::id();
            $comment->blog_id = $blogId;
            $comment->parent_id = null; 
            $comment->save();
        }

        return response()->json(['status' => 'success']);
    }
}
