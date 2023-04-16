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

class TestController extends Controller
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
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->firstOrFail();
        if ($user->topic < $progress->topic_id || $progress->task_number < 4) {
            return back()->with('info', 'Пройдите задания');
        }

        if (!$progress->test_end_at) {
            $progress->update([
                'test_end_at' => Carbon::now()->addMinutes(20),
            ]);
        }

        $test = $progress->topic->getTest();
        $status = $progress->test_status;
        $timer =  $progress->fresh()->getTestTimer();
        return view('user.topic.test.questions', compact('topic', 'test', 'status', 'timer'));
    }

    public function check(Topic $topic, Request $request)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();
        if ($progress->test_status == -5) {
            return redirect(route('course'));
        }

        if ($progress->test_status <= -2) {
            return back();
        }

        $progress->update([
            'tries' => $progress->tries + 1,
        ]);
        $progress = $progress->fresh();
        $mistakes = 0;
        $points = 0;
        $replies = $request->input('answer');
        $answers = $topic->getTestAnswers();
        for ($index = 0; $index  < count($replies); $index++) {
            $reply = $replies[$index];
            $answer = $answers[$index]->data;
            if ($reply != $answer) {
                $mistakes++;
            } else {
                $points++;
            }
        }


        if ($mistakes == 0) {
            $progress->update([
                'test_points' => max($progress->points, $points),
                'test_status' =>  -3,
            ]);
        } else if ($mistakes < 2) {
            $progress->update([
                'test_points' => max($progress->points, $points),
                'test_status' =>  min($progress->test_status, -1),
            ]);
        }

        $progress = $progress->fresh();
        if ($progress->tries >= 3) {
            if ($progress->test_points > 0) {
                $progress->update([
                    'test_points' => max($progress->points, $points),
                    'test_status' => $mistakes == 0 ? -3 : min($progress->test_status, -2),
                ]);
            } else {
                if ($progress->test_status == 2) {
                    $progress->update([
                        'test_status' => -4,
                    ]);
                } else {
                    $progress->update([
                        'test_status' => 1,
                    ]);

                    return redirect(route('test.help', $topic));
                }
            }
        }

        $info = 'Попробуйте еще раз';
        $progress = $progress->fresh();
        switch ($progress->test_status) {
            case '-4':
                $info = 'Не осталось попыток, переходите на следующую тему';
                break;
            case '-3':
                $info = 'Отлично, переходите на следующую тему';
                break;
            case '-2':
                $info = 'Хорошо, переходите на следующую тему';
                break;
            case '-1':
                $info = 'Хорошо, можете попробовать еще раз или перейти на следующуюю тему';
                break;
            default:
                # code...
                break;
        }

        return back()->with('info', $info);
    }

    public function end(Topic $topic)
    {
        $user = User::find(auth()->user()->id);
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();

        if ($progress->test_status == -5 || $progress->test_status >= 0) {
            return redirect(route('course'));
        }

        $progress->update([
            'test_status' => -5,
        ]);

        $user->update([
            'points' => $user->points + $progress->test_points,
            'topic' => $topic->id + 1,
        ]);
        $next_record = Topic::where('id', '>', $topic->id)->orderBy('id')->first();

        if (!$next_record) {
            return redirect(route('profile'));
        }

        return redirect(route('topic', $next_record));
    }
}
