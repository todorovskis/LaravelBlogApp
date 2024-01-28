<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function create(Blog $blog)
    {
        return view('comment', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $blog = Blog::findOrFail($request->input('blog_id'));
        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
        ]);

        $blog->comments()->save($comment);
        return redirect()->route('dashboard', ['blog' => $blog->id])
            ->with('success', 'Comment added successfully');
    }


    public function destroy($blogId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('blogs.show', $blogId);
    }
}
