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

class HomeworkController extends Controller
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

    public function test(Topic $topic)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->firstOrFail();
        if ($user->topic < $progress->topic_id || $progress->task_number < 4) {
            return back()->with('info', 'Пройдите задания');
        }

        $test = $progress->topic->getTest();
        $status = $progress->test_status;
        return view('user.topic.test.questions', compact('topic', 'test', 'status'));
    }

    public function testHelp(Topic $topic)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();
        return view('user.topic.test.help.index', compact('progress', 'topic'));
    }

    public function testCheck(Topic $topic, Request $request)
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
                'test_status' => -3,
            ]);
        } else if ($mistakes < 2) {
            $progress->update([
                'test_points' => max($progress->points, $points),
                'test_status' => -1,
            ]);
        }

        $progress = $progress->fresh();
        if ($progress->tries >= 3) {
            if ($progress->test_points > 0) {
                $progress->update([
                    'test_points' => max($progress->points, $points),
                    'test_status' => $mistakes == 0 ? -3 : -2,
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

    public function endTest(Topic $topic)
    {
        $user = User::find(auth()->user()->id);
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();
        if ($progress->test_status == -2) {
            // if($progress->tries >= 3){
            //     $progress->update([
            //         'test_status' => -2,
            //     ]);
            //     return back()->with('fail','Вы не смогли пройти тест');
            // }

            return back();
        }

        $progress->update([
            'test_status' => $progress->tries > 3 ? -2 : -1,
        ]);
        $progress = $progress->fresh();

        $user->update([
            'points' => $user->points + $progress->test_points,
            'topic' => $progress->topic_id + 1,
        ]);

        if ($user->fresh()->topic > 11) {
            return back()->with('end', 'Поздравляем, вы прошли курс! Заберите сертификат в профиле');
        }

        return back()->with('next', 'Следующая тема');
    }

    public function testHelpCheck(Topic $topic, Request $request)
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->first();

        $answer = $topic->getHelpAnswer();
        $reply = $request->answer;
        if ($answer == $reply) {
            return back()->with('success', 'Правильно');
        } else {
            return back()->with('error', 'Попробуйте еще раз');
        }
    }

    public function testHelpCheckTest(Topic $topic, Request $request)
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
                return view('user.topic.task.question', ['started' => true, 'task' => $task, 'task_number' => 1, 'timer' => $progress->fresh()->getTimer() ?? -1]);
            }

            return false;
        }

        $progress = Progress::create([
            'user_id' => $user->id,
            'topic_id' => $user->topic,
            'task_end_at' => Carbon::now()->addMinutes($user->hard == 0 ? 5 : 7),
            'task_number' => 1,
        ]);

        $task = $progress->topic->getTask(1);
        return view('user.topic.task.question', ['started' => true, 'task' => $task, 'task_number' => 1, 'timer' => $progress->fresh()->getTimer() ?? -1]);
    }

    public function nextTask()
    {
        $user = auth()->user();
        $progress = Progress::where('user_id', $user->id)->where('topic_id', $user->topic)->firstOrFail();
        $task_number = $progress->task_number + 1;

        $progress->update([
            'task_end_at' => Carbon::now()->addMinutes($user->hard == 0 ? 5 : 7),
            'task_number' => $task_number,
            'mistakes' => 0,
        ]);

        if ($task_number > 3) {
            return -1;
        }

        $task = $progress->topic->getTask($task_number);
        return view('user.topic.task.question', ['started' => true, 'task' => $task, 'task_number' => $task_number, 'timer' => $progress->fresh()->getTimer() ?? -1]);
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
