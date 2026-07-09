<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'commentable_type' => $request->commentable_type,
            'commentable_id' => $request->commentable_id,
            'parent_id' => $request->parent_id,
            'body' => $request->body,
        ]);

        CommentPosted::dispatch($comment, auth()->user());

        return back()->with('success', 'Comment added.');
    }

    public function destroy(Comment $comment)
    {
        $user = auth()->user();
        if ($comment->user_id !== $user->id) {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }
}
