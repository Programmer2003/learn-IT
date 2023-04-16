<?php

namespace App\Providers;

use App\Models\Progress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::if('admin', function () {
            return auth()->user()->admin;
        });

        Blade::if('mode_change', function () {
            $user = auth()->user();
            $now = Carbon::now();
            $end = new Carbon($user->end_at);
            $length = $now->diffInDays($end, false);
            return $length > 6 && !$user->mode_changed_at;
        });
    }
}
