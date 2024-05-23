<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LectureAccessController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestInteractive;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[PageController::class, 'home'])->name('home');

Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('lectures', LectureController::class);
Route::resource('blogs', BlogController::class);
Route::resource('tests', TestController::class);
Route::resource('questions', QuestionController::class);
Route::get('/tests/{test}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/tests/{test}/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/tests/{test}/test-interactive/create', [TestInteractive::class, 'create'])->name('test-interactive.create');
Route::post('/tests/{test}/test-interactive', [TestInteractive::class, 'store'])->name('test-interactive.store');
Route::get('about-us',[PageController::class, 'about'])->name('about');
Route::get('contact',[PageController::class, 'contact'])->name('contact');
Route::get('blog',[PageController::class, 'BlogUser'])->name('blog-user');
Route::get('blog-detail/{blog}', [PageController::class, 'BlogDetail'])->name('blog.detail');
Route::get('/content', [ContentController::class, 'index'])->name('content');
Route::get('/content/lecture/{lecture}', [ContentController::class, 'showLecture'])->name('lecture.details');
Route::get('/content/test/{test}', [ContentController::class, 'testing'])->name('test.details');
Route::get('/content/test-interactive/{test}', [ContentController::class, 'testInteractive'])->name('test.test-interactive');
Route::post('/lecture-access', [LectureAccessController::class, 'store']);

require __DIR__.'/auth.php';
