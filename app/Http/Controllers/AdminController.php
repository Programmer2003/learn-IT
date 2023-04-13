<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Progress;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->where('admin', '!=', '1');
        $topic = Topic::first();
        return view('admin.users', compact('users', 'topic'));
    }

    public function downloadHomework(Request $request)
    {
        $userEmail = $request->user;
        $topicId = $request->topic;
        $files = Storage::files($userEmail . '/' . $topicId);
        if (count($files) == 0) {
            return redirect()->back()->with('error', 'нет файла');
        }

        $url = Storage::download($files[0]);
        return $url;
    }

    public function homeworkUploaded(Request $request)
    {
        $userEmail = $request->user;
        $topicId = $request->topic;
        $files = Storage::files($userEmail . '/' . $topicId);
        return count($files) != 0;
    }


    public function homeworkUpdate(Request $request)
    {
        $userId = $request->user;
        $topicId = $request->topic;
        $mark  = $request->mark;
        $progress = Progress::where('user_id', $userId)->where('topic_id', $topicId)->first();
        if ($progress) {
            return $progress->update([
                'homework_mark' => $request->mark
            ]);
        }

        return Progress::create([
            'user_id' => $userId,
            'topic_id' => $topicId,
            'homework_mark' => $mark,
        ]);
    }

    public function tableUser(Request $request)
    {
        $user = User::find($request->user);
        $topic = Topic::find($request->topic);
        return view('admin.user-row', compact('user', 'topic'));
    }
}
