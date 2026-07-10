<?php

namespace App\Http\Controllers;

use App\Actions\Comments\CreateComment;
use App\Events\CommentPosted;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $clean = $request->validated();

        $clean['user_id'] = auth()->id();

        $comment = (new CreateComment)($clean);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Comment added.',
                'data' => $comment->load('user'),
            ]);
        }

        return back()->with('success', 'Comment added.');
    }

    public function destroy(Comment $comment)
    {
        $user = auth()->user();
        if ($comment->user_id !== $user->id) {
            abort(403);
        }

        $comment->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Comment deleted.',
            ]);
        }

        return back()->with('success', 'Comment deleted.');
    }
}
