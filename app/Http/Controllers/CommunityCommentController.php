<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityComment;

class CommunityCommentController extends Controller
{
    public function store(Request $request, $communityId)
    {
        $request->validate(['comment' => 'required|string']);
        CommunityComment::create([
            'community_id' => $communityId,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);
        return redirect()->back();
    }
}