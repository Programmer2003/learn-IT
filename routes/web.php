<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HelpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Models\Progress;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //auth errors

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/home');

Route::get('/t', function () {
    $progress = Progress::first();
    //dd($progress->topic->getTask(1));
    $test = $progress->topic->getTest();
    // dd($test);
    $started = true;
    return view('t', compact('test', 'started'));
});


Route::get('/t2', function (Request $request) {
    dd($request->all());
})->name('t2');

Route::get('/tt', function (Request $request) {
    return view('t');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('themes', function() {
//     return session('theme','light');
//     // $request->validate([
//     //    'theme' => ['required', Rule::in(['darkly', 'cerulean'])]
//     // ]);
//         $theme = 'light';
//     session(['theme' => $theme]);
//     return 1;
//  });

Route::get('/test', [HomeController::class, 'test'])->name('test');
Route::post('/test', [HomeController::class, 'testScore'])->name('test.score');

Route::middleware(['is_admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('users', [AdminController::class, 'index'])->name('admin');

        Route::prefix('homework')->group(function () {
            Route::post('download', [AdminController::class, 'downloadHomework'])->name('homework.download');
            Route::post('uploaded', [AdminController::class, 'homeworkUploaded'])->name('homework.uploaded');
            Route::post('update', [AdminController::class, 'homeworkUpdate'])->name('homework.update');
        });
        
        // Route::post('homework/download', [AdminController::class, 'downloadHomework'])->name('homework.download');
        // Route::post('homework/uploaded', [AdminController::class, 'homeworkUploaded'])->name('homework.uploaded');
        // Route::post('homework/update', [AdminController::class, 'homeworkUpdate'])->name('homework.update');

        Route::post('table/user', [AdminController::class, 'tableUser'])->name('table.user');
    });
});

Route::post('/homework', [UserController::class, 'homework'])->name('homework');

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [UserController::class, 'index'])->name('profile');
    Route::get('course', [UserController::class, 'course'])->name('course');

    Route::prefix('{topic:slug}')->group(function () {
        Route::get('', [TopicController::class, 'index'])->name('topic')->middleware('topic_access');
        Route::get('test', [TestController::class, 'index'])->name('topic.test')->middleware('test_access');
        Route::post('test/check', [TestController::class, 'check'])->name('test.check');

        Route::prefix('test/help')->group(function () {
            Route::get('', [HelpController::class, 'index'])->name('test.help')->middleware('test_help_access');
            Route::post('check', [HelpController::class, 'check'])->name('test.help.check');
            Route::get('test/check', [HelpController::class, 'checkTest'])->name('test.help.checkTest');
        });
    });

    // Route::get('{topic:slug}', [UserController::class, 'topic'])->name('topic')->middleware('topic_access');
    // Route::get('{topic:slug}/test', [UserController::class, 'test'])->name('topic.test')->middleware('test_access');
    // Route::post('{topic:slug}/test/check', [UserController::class, 'testCheck'])->name('test.check');

    // Route::get('{topic:slug}/test/help', [UserController::class, 'testHelp'])->name('test.help')->middleware('test_help_access');
    // Route::post('{topic:slug}/test/help/check', [UserController::class, 'testHelpCheck'])->name('test.help.check');
    // Route::get('{topic:slug}/test/help/checkTest', [UserController::class, 'testHelpCheckTest'])->name('test.help.checkTest');

    Route::prefix('task')->group(function () {
        Route::post('start', [TaskController::class, 'start'])->name('task.start');
        Route::post('next', [TaskController::class, 'next'])->name('task.next');
        Route::post('check', [TaskController::class, 'check'])->name('task.check');
        Route::post('additional', [TaskController::class, 'additionalCheck'])->name('task.additional');
    });
});
