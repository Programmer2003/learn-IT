<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carousel = Carousel::take(3)->get();
        $topics  = Topic::all();
        return view('home', compact('carousel', 'topics'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test()
    {
        return view('test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function testScore(Request $request)
    {
        $sum = 0;
        foreach ($request->all() as $key => $value) {
            if (is_numeric($value)) {
                $sum += $value;
            }
        }

        if ($sum < 3) {
            return rand(100, 499);
        }

        return rand(500, 999);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin');
    }
}
