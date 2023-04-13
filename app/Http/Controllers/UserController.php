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

class UserController extends Controller
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
    public function index()
    {
        $topics = Topic::where('id', '<', auth()->user()->topic)->get();
        return view('user.profile', compact('topics'));
    }

    public function course()
    {
        $topics = Topic::all();
        return view('user.course', compact('topics'));
    }

    public function topic(Topic $topic)
    {
        $progress = Progress::where('user_id', auth()->user()->id)->where('topic_id', $topic->id)->first() ?? (object) array('task_end_at' => null);
        return view('user.topic', compact('topic', 'progress'));
    }

    public function homework(Request $request)
    {
        $file = $request->file('file');
        $path = $file->storeAs(auth()->user()->email . "/" . $request->topic, $file->getClientOriginalName());

        return redirect()->back()->with('success', 'Файл загружен');
    }

    public function startTask(Request $request)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $user->topic)->first();
        if ($progress) {
            if (!$progress->task_end_at) {
                $progress->update([
                    'task_end_at' => Carbon::now()->addMinutes($user->hard == 0 ? 5 : 7),
                    'task_number' => 1,
                    'mistakes' => 0,
                ]);

                $task = $progress->topic->getTask(1);
                return view('user.task', ['started' => true, 'task' => $task, 'task_number' => 1, 'timer' => $progress->fresh()->getTimer() ?? -1]);
            }

            return false;
        }

        $progress = Progress::create([
            'user_id' => $user->id,
            'topic_id' => $user->topic,
            'task_end_at' => Carbon::now()->addMinutes(6),
            'task_number' => 1,
        ]);

        $task = $progress->topic->getTask(1);
        dd($progress->getTimer() ?? -1);
        return view('user.task', ['started' => true, 'task' => $task, 'task_number' => 1, 'timer' => $progress->fresh()->getTimer() ?? -1]);
    }

    public function nextTask()
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $user->topic)->firstOrFail();
        $task_number = $progress->task_number + 1;

        $progress->update([
            'task_end_at' => Carbon::now()->addMinutes(6),
            'task_number' => $task_number,
            'mistakes' => 0,
        ]);

        if ($task_number > 3) {
            return -1;
        }

        $task = $progress->topic->getTask($task_number);
        return view('user.task', ['started' => true, 'task' => $task, 'task_number' => $task_number, 'timer' => $progress->fresh()->getTimer() ?? -1]);
    }

    public function checkTask(Request $request)
    {
        $answer = $request->answer;
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $user->topic)->firstOrFail();
        $task_number = $progress->task_number;
        $mistakes = $progress->mistakes;
        if ($mistakes < 0) {
            return json_encode([
                'case' => -1,
            ]);
        }

        if ($progress->topic->getAnswer($task_number) == $answer) {
            $user = User::find(auth()->user()->id);
            $now = Carbon::now();
            $diff =  $now->diffInSeconds($progress->task_end_at, false);
            $progress->update([
                'mistakes' => -1,
            ]);

            if ($diff > 0) {
                if ($mistakes == 0) {
                    $user->update([
                        'points' => $user->points + 10,
                    ]);

                    return json_encode([
                        'case' => 1,
                        'task' => [
                            'text' => $progress->topic->getMore($progress->task_number)->text,
                            'url' =>  $progress->topic->getMore($progress->task_number)->url,
                        ],
                    ]);
                }

                if ($mistakes < 3) {
                    $user->update([
                        'points' => $user->points + 4,
                    ]);

                    return json_encode([
                        'case' => 3,
                    ]);
                }

                return json_encode([
                    'case' => 4,
                ]);
            }

            if ($mistakes == 0) {
                $user->update([
                    'points' => $user->points + 10,
                ]);

                return json_encode([
                    'case' => 2,
                ]);
            }

            if ($mistakes < 3) {
                $user->update([
                    'points' => $user->points + 4,
                ]);

                return json_encode([
                    'case' => 3,
                ]);
            }

            return json_encode([
                'case' => 4,
            ]);
        }


        $progress->update([
            'mistakes' => $mistakes + 1,
        ]);

        if ($mistakes == 2) {
            return json_encode([
                'case' => 5,
                'text' => $progress->topic->getHelp($progress->task_number)->text,
            ]);
        }

        if ($mistakes == 3) {
            return json_encode([
                'case' => 6,
                'url' => $progress->topic->getHelp($progress->task_number)->url,
            ]);
        }

        if ($mistakes > 3) {
            return json_encode([
                'case' => 7,
                'answer' => 'Ответ: ' . $progress->topic->getAnswer($progress->task_number),
            ]);
        }

        return  json_encode([
            'case' => 0,
        ]);;
    }

    public function additionalTaskCheck(Request $request)
    {
        $answer =  $request->answerMore;
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $user->topic)->firstOrFail();
        $task_number = $progress->task_number;
        $mistakes = $progress->mistakes;

        if ($mistakes == -2) {
            return $progress->topic->getAnswerMore($task_number) == $answer;
        }

        $user = User::find($user->id);
        if ($progress->topic->getAnswerMore($task_number) == $answer) {
            $user->update([
                'points' => $user->points + 5,
            ]);

            $progress->update([
                'mistakes' => -2,
            ]);

            return true;
        }

        $progress->update([
            'mistakes' => -2,
        ]);

        return false;
    }
}
