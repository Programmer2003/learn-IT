<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Progress;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Topic $topic)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();
        if (!$progress) {
            $progress = Progress::create([
                'user_id' => $user->id,
                'topic_id' => $user->topic,
            ]);
        }

        return view('user.topic.index', compact('topic', 'progress'));
    }
}
