<?php

use App\Http\Controllers\AuthenticatedRedirectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\InteractiveSimulatorController;
use App\Http\Controllers\LectureAccessController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SimulatorQuizController;
use App\Http\Controllers\TestController;
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

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('about-us', [PageController::class, 'about'])->name('about');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::get('blog', [PageController::class, 'BlogUser'])->name('blog-user');
Route::get('blog-detail/{blog}', [PageController::class, 'BlogDetail'])->name('blog.detail');

// Authenticated Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])
        ->middleware('verified')
        ->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

    // User Content Routes
    Route::get('/user-lectures', [ContentController::class, 'UserLectures'])->name('user-lectures');
    Route::get('/user-tests', [ContentController::class, 'UserTests'])->name('user-tests');
    Route::get('/user-lectures/lecture/{lecture}', [ContentController::class, 'showLecture'])->name('lecture.details');
    Route::get('/content/test/{test}', [ContentController::class, 'testing'])->name('test.details');

    // Interactive Simulator and Quiz Routes
    Route::get('/content/simulator-quiz/{test}', [ContentController::class, 'SimulatorQuizShow'])->name('test.simulator-quiz');
    Route::get('/content/interactive-simulator/{test}', [ContentController::class, 'InteractiveSimulatorShow'])->name('test.interactive-simulator');

    // Lecture Access
    Route::post('/lecture-access', [LectureAccessController::class, 'store']);

    // Comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Resource Routes
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('lectures', LectureController::class);
Route::resource('blogs', BlogController::class);
Route::resource('tests', TestController::class);
Route::resource('questions', QuestionController::class);

// Nested Routes for Test Interactions
Route::prefix('tests/{test}')->group(function () {
    Route::get('test-interactive/create', [InteractiveSimulatorController::class, 'create'])->name('questions.create');
    Route::post('test-interactive', [InteractiveSimulatorController::class, 'store'])->name('questions.store');
    Route::get('simulator-quiz/create', [SimulatorQuizController::class, 'create'])->name('test-interactive.create');
    Route::post('simulator-quiz', [SimulatorQuizController::class, 'store'])->name('test-interactive.store');
});

// Authentication Routes
require __DIR__.'/auth.php';
