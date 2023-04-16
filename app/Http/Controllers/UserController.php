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
        return view('user.profile.index');
    }

    public function course()
    {
        $topics = Topic::all();
        return view('user.course', compact('topics'));
    }
    
    public function homework(Request $request)
    {
        $file = $request->file('file');
        $path = $file->storeAs(auth()->user()->email . "/" . $request->topic, $file->getClientOriginalName());

        return redirect()->back()->with('success', 'Файл загружен');
    }
}
