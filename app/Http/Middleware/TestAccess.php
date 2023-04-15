<?php

namespace App\Http\Middleware;

use App\Models\Progress;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class TestAccess
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $topic = $request->topic;
        if(!$topic){
            return back();
        }

        $progress = Progress::where('user_id', $user->id)->where('topic_id', $topic->id)->firstOrFail();
        if ($progress->test_status == 1) {
            return redirect(route('test.help',$topic));
        }
        
        return $next($request);
    }
}
