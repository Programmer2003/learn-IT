<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Progress;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use LengthException;

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
        return view('user.profile.index');
    }

    public function course()
    {
        $topics = Topic::all();
        return view('user.course', compact('topics'));
    }

    public function checklist()
    {
        return view('user.checklist');
    }

    public function homework(Request $request)
    {
        $file = $request->file('file');
        $path = $file->storeAs(auth()->user()->email . "/" . $request->topic, $file->getClientOriginalName());

        return redirect()->back()->with('success', 'Файл загружен');
    }

    public function mode()
    {

        $user = User::find(Auth::id());

        $now = Carbon::now();
        $end = new Carbon($user->end_at);
        $length = $now->diffInDays($end, false);
        $mode = $user->mode;
        if ($mode) {
            $length = $length * 2;
            $date = $now->addDays($length + 1);
            $user->update([
                'mode' => false,
                'mode_changed_at' => Carbon::now(),
                'end_at' => $date,
            ]);
        } else {
            $length = round($length / 2);
            $date = $now->addDays($length + 1);
            $user->update([
                'mode' => true,
                'mode_changed_at' => Carbon::now(),
                'end_at' => $date,
            ]);
        }

        return back()->with('mode_change', 'Режим изменен');
    }
}
