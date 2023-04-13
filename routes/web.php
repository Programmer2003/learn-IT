<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\Progress;
use App\Models\Topic;

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
    $task = $progress->topic->getMore(2);
    $task = $progress->topic->getAnswerMore(1);
    dd($task);
    return view('t',compact('task'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

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
    Route::get('{topic}', [UserController::class, 'topic'])->name('topic')->middleware('topic_access');
    Route::post('task/start', [UserController::class, 'startTask'])->name('task.start');
    Route::post('task/next', [UserController::class, 'nextTask'])->name('task.next');
    Route::post('task/check', [UserController::class, 'checkTask'])->name('task.check');
    Route::post('task/additional', [UserController::class, 'additionalTaskCheck'])->name('task.additional');
});
