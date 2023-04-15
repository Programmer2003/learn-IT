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

class HelpController extends Controller
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

    public function index(Topic $topic)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();
        return view('user.topic.test.help.index', compact('progress', 'topic'));
    }

    public function check(Topic $topic, Request $request)
    {
        $answer = $topic->getHelpAnswer();
        $reply = $request->answer;
        if ($answer == $reply) {
            return back()->with('success', 'Правильно');
        } else {
            return back()->with('error', 'Попробуйте еще раз');
        }
    }

    public function checkTest(Topic $topic, Request $request)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();
        $progress = $progress->fresh();
        $mistakes = 0;
        $points = 0;
        $replies = $request->input('answer');
        $answers = $topic->getHelpTestTaskAnswers();

        for ($index = 0; $index  < count($replies); $index++) {
            $reply = $replies[$index];
            $answer = $answers[$index]->data;
            if ($reply != $answer) {
                $mistakes++;
            } else {
                $points++;
            }
        }

        if ($mistakes < 2) {
            $progress->update([
                'test_status' => 2,
            ]);

            return redirect(route('topic.test', $topic))->with('last', 'У вас последняя попытка пройти тест');
        }
        $progress->update([
            'test_status' => -1,
        ]);

        return redirect(route('topic.test', $topic));
    }
}
