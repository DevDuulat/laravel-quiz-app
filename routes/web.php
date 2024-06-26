<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ImageQuizController;
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
    Route::get('/content/image-quiz/{test}', [ContentController::class, 'ImageQuizShow'])->name('test.image-quiz');

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
    Route::get('test-interactive/create', [InteractiveSimulatorController::class, 'create'])->name('test-interactive.create');
    Route::post('test-interactive', [InteractiveSimulatorController::class, 'store'])->name('test-interactive.store');
    Route::get('test-interactive/{question}/edit', [InteractiveSimulatorController::class,'edit'])->name('test-interactive.edit');
    Route::put('test-interactive/{question}', [InteractiveSimulatorController::class, 'update'])->name('test-interactive.update');
    Route::get('test-interactive/questions', [InteractiveSimulatorController::class, 'show'])->name('test-interactive.show');
    Route::delete('test-interactive/{question}', [InteractiveSimulatorController::class, 'destroy'])->name('test-interactive.destroy');


    Route::get('simulator-quiz/create', [SimulatorQuizController::class, 'create'])->name('simulator-quiz.create');
    Route::post('simulator-quiz', [SimulatorQuizController::class, 'store'])->name('simulator-quiz.store');
    Route::get('simulator-quiz/questions', [SimulatorQuizController::class, 'show'])->name('simulator-quiz.show');
    Route::get('simulator-quiz/{question}/edit', [SimulatorQuizController::class,'edit'])->name('simulator-quiz.edit');
    Route::put('simulator-quiz/{question}', [SimulatorQuizController::class, 'update'])->name('simulator-quiz.update');
    Route::delete('simulator-quiz/{question}', [SimulatorQuizController::class, 'destroy'])->name('simulator-quiz.destroy');

    Route::get('image-quiz/create', [ImageQuizController::class, 'create'])->name('image-quiz.create');
    Route::post('image-quiz', [ImageQuizController::class, 'store'])->name('image-quiz.store');
    Route::get('image-quiz/questions', [ImageQuizController::class, 'show'])->name('image-quiz.show');
    Route::get('image-quiz/{imageQuiz}/edit', [ImageQuizController::class,'edit'])->name('image-quiz.edit');
    Route::put('image-quiz/{imageQuiz}', [ImageQuizController::class, 'update'])->name('image-quiz.update');
    Route::delete('image-quiz/{imageQuiz}', [ImageQuizController::class, 'destroy'])
        ->name('image-quiz.destroy');

});

// Authentication Routes
require __DIR__.'/auth.php';
