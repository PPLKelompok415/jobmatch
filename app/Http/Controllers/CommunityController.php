<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function index()
    {
        $tab = request('tab');
        $user = auth()->user();

        if ($tab === 'liked') {
            $likedComments = \App\Models\CommunityLike::where('user_id', $user->id)
                ->with('community.user')
                ->get();
            return view('community.index', [
                'tab' => $tab,
                'likedComments' => $likedComments,
                'messages' => collect(),
                'historyQuestions' => collect(),
            ]);
        } elseif ($tab === 'history') {
            // Ambil semua pertanyaan (diskusi) yang pernah dibuat user beserta komentarnya
            $historyQuestions = \App\Models\Community::with(['comments.user'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
            return view('community.index', [
                'tab' => $tab,
                'historyQuestions' => $historyQuestions,
                'messages' => collect(),
                'likedComments' => collect(),
            ]);
        } else {
            $messages = \App\Models\Community::with(['user', 'likes', 'comments.user'])->latest()->get();
            return view('community.index', [
                'tab' => $tab,
                'messages' => $messages,
                'likedComments' => collect(),
                'historyQuestions' => collect(),
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

    public function destroy($id)
    {
        $user = auth()->user();
        $question = \App\Models\Community::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $question->delete();

        return redirect()->route('community.index', ['tab' => 'history'])->with('success', 'Pertanyaan berhasil dihapus.');
    }
}