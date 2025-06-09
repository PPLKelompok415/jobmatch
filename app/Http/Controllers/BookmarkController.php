<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; // Model untuk pekerjaan
use App\Models\Bookmark; // Model untuk bookmark

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $jobId = $request->input('job_id');
        $userId = auth()->id(); // Ambil ID pengguna yang sedang login

        // Cek apakah bookmark sudah ada
        $exists = Bookmark::where('user_id', $userId)->where('job_id', $jobId)->exists();

        if (!$exists) {
            // Simpan bookmark baru
            Bookmark::create([
                'user_id' => $userId,
                'job_id' => $jobId,
            ]);

            return response()->json(['message' => 'Job saved to bookmarks.']);
        }

        return response()->json(['message' => 'Job already bookmarked.'], 400);
    }

    public function index()
    {
        $userId = auth()->id();

        // Ambil semua bookmark user beserta data pekerjaan (job)
        $bookmarks = Bookmark::with('job')
            ->where('user_id', $userId)
            ->get();

        foreach ($bookmarks as $bookmark) {
            $job = $bookmark->job;
            $companyUserId = $job?->company?->user_id ?? null;
            $hasChat = false;
            if ($companyUserId) {
                $hasChat = \App\Models\Message::where(function($q) use ($userId, $companyUserId, $job) {
                    $q->where('sender_id', $userId)->where('receiver_id', $companyUserId)->where('job_id', $job->id);
                })->orWhere(function($q) use ($userId, $companyUserId, $job) {
                    $q->where('sender_id', $companyUserId)->where('receiver_id', $userId)->where('job_id', $job->id);
                })->exists();
            }
            $bookmark->has_chat = $hasChat;
            $bookmark->company_user_id = $companyUserId;
        }

        return view('job-matching.bookmark', compact('bookmarks', 'userId'));
    }
    
    public function destroy($id)
    {
        $userId = auth()->id();

        // Hapus bookmark berdasarkan ID dan user_id
        $bookmark = Bookmark::where('id', $id)->where('user_id', $userId)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['message' => 'Bookmark deleted successfully.']);
        }

        return response()->json(['message' => 'Bookmark not found.'], 404);
    }
}
