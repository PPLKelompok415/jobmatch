<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $bookmarkId)
    {
        $request->validate(['comment' => 'required|string']);
        Comment::create([
            'user_id' => auth()->id(),
            'bookmark_id' => $bookmarkId,
            'comment' => $request->comment,
        ]);
        return redirect()->back();
    }
}