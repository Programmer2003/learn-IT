<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\Progress;
use App\Models\Topic;
use Illuminate\Http\Request;

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
    return view('t',compact('test','started'));
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
        Route::post('homework/download', [AdminController::class, 'downloadHomework'])->name('homework.download');
        Route::post('homework/uploaded', [AdminController::class, 'homeworkUploaded'])->name('homework.uploaded');
        Route::post('homework/update', [AdminController::class, 'homeworkUpdate'])->name('homework.update');
        Route::post('table/user', [AdminController::class, 'tableUser'])->name('table.user');
    });
});

Route::post('/homework', [UserController::class, 'homework'])->name('homework');

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [UserController::class, 'index'])->name('profile');
    Route::get('course', [UserController::class, 'course'])->name('course');
    Route::get('{topic:slug}', [UserController::class, 'topic'])->name('topic')->middleware('topic_access');
    Route::get('{topic:slug}/test', [UserController::class, 'test'])->name('topic.test')->middleware('test_access');
    Route::get('{topic:slug}/test/help', [UserController::class, 'testHelp'])->name('test.help')->middleware('test_help_access');
    Route::post('{topic}/test/help/check', [UserController::class, 'testHelpCheck'])->name('test.help.check');
    Route::get('{topic}/test/help/checkTest', [UserController::class, 'testHelpCheckTest'])->name('test.help.checkTest');
    Route::post('{topic}/test/check', [UserController::class, 'testCheck'])->name('test.check');
    Route::post('task/start', [UserController::class, 'startTask'])->name('task.start');
    Route::post('task/next', [UserController::class, 'nextTask'])->name('task.next');
    Route::post('task/check', [UserController::class, 'checkTask'])->name('task.check');
    Route::post('task/additional', [UserController::class, 'additionalTaskCheck'])->name('task.additional');
});

