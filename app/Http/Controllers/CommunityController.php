<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function index()
    {
        $tab = request('tab');
        if ($tab === 'liked') {
            $user = auth()->user();
            $likedComments = \App\Models\CommunityLike::where('user_id', $user->id)
                ->with('community.user')
                ->get();
            return view('community.index', [
                'tab' => $tab,
                'likedComments' => $likedComments,
                'messages' => collect(), // kosongkan messages
            ]);
        } else {
            $messages = \App\Models\Community::with(['user', 'likes', 'comments.user'])->latest()->get();
            return view('community.index', [
                'tab' => $tab,
                'messages' => $messages,
                'likedComments' => collect(), // kosongkan likedComments
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        Community::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);
        return redirect()->back();
    }

    public function like($id)
    {
        $community = \App\Models\Community::findOrFail($id);
        $user = auth()->user();

        $like = $community->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // Unlike
            $like->delete();
        } else {
            // Like
            $community->likes()->create(['user_id' => $user->id]);
        }

        // Update kolom likes di tabel communities
        $community->likes = $community->likes()->count(); // gunakan 'likes' jika nama kolomnya 'likes'
        $community->save();

        return back();
    }

    public function likedComments()
    {
        $user = auth()->user();
        // Ambil komentar yang disukai user
        $likedComments = \App\Models\CommunityLike::where('user_id', $user->id)
            ->with(['community', 'community.comments.user'])
            ->get();

        return view('community.liked_comments', compact('likedComments'));
    }
}