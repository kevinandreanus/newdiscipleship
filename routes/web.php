<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\BibleController;
use App\Http\Controllers\EventNotesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SliderController;
use App\Models\EventNote;
use App\Models\Schedule;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function () {
    $sliders = Slider::all();
    $user = User::find(Auth::id());

    return view('index', compact('sliders', 'user'));
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/edit-profile/{id}', [ProfileController::class, 'editProfile'])->middleware(['auth', 'verified'])->name('edit-profile');
Route::post('/update-profile/picture', [ProfileController::class, 'updateProfilePicture'])->middleware(['auth', 'verified']);
Route::post('/update-profile/main', [ProfileController::class, 'updateProfileMain'])->middleware(['auth', 'verified']);
Route::post('/update-profile/additional', [ProfileController::class, 'updateProfileAdditional'])->middleware(['auth', 'verified']);
Route::post('/update-profile/spiritual', [ProfileController::class, 'updateProfileSpiritual'])->middleware(['auth', 'verified']);

Route::get('/schedule/{id}', [ScheduleController::class, 'index'])->middleware(['auth', 'verified'])->name('schedule-index');
Route::get('/schedule/data/{id}', [ScheduleController::class, 'scheduleData'])->middleware(['auth', 'verified'])->name('schedule-data');
Route::get('/schedule/data/each/{id}', [ScheduleController::class, 'scheduleEachData'])->middleware(['auth', 'verified'])->name('schedule-each-data');
Route::post('/add-schedule', [ScheduleController::class, 'store'])->middleware(['auth', 'verified'])->name('schedule-add');
Route::get('/schedule/check-in/{id}', [ScheduleController::class, 'check_in'])->middleware(['auth', 'verified'])->name('schedule-check-in');

Route::post('/schedule/notes/store', [EventNotesController::class, 'store'])->middleware(['auth', 'verified'])->name('schedule-notes-store');
Route::get('/schedule/notes/get/{id}', [EventNotesController::class, 'get'])->middleware(['auth', 'verified'])->name('schedule-notes-get');

Route::get('/slider/edit', [SliderController::class, 'edit'])->middleware(['auth', 'verified'])->name('slider-edit');
Route::post('/slider/store', [SliderController::class, 'store'])->middleware(['auth', 'verified'])->name('slider-store');
Route::get('/slider/delete/{id}', [SliderController::class, 'delete'])->middleware(['auth', 'verified'])->name('slider-delete');

Route::get('/assessment', [AssessmentController::class, 'index'])->middleware(['auth', 'verified'])->name('assessment-index');
Route::get('/assessment/manage', [AssessmentController::class, 'manage'])->middleware(['auth', 'verified'])->name('assessment-manage');
Route::get('/assessment/add', [AssessmentController::class, 'add'])->middleware(['auth', 'verified'])->name('assessment-add');
Route::post('/assessment/store', [AssessmentController::class, 'store'])->middleware(['auth', 'verified'])->name('assessment-store');
Route::get('/assessment/edit/{id}', [AssessmentController::class, 'edit'])->middleware(['auth', 'verified'])->name('assessment-edit');
Route::get('/assessment/delete/{id}', [AssessmentController::class, 'delete'])->middleware(['auth', 'verified'])->name('assessment-delete');

Route::post('/question/store', [AssessmentController::class, 'question_store'])->middleware(['auth', 'verified'])->name('question-store');
Route::get('/question/delete/{id}', [AssessmentController::class, 'question_delete'])->middleware(['auth', 'verified'])->name('question-delete');
Route::get('/question/edit/{id}', [AssessmentController::class, 'question_edit'])->middleware(['auth', 'verified'])->name('question-edit');
Route::post('/question/update', [AssessmentController::class, 'question_update'])->middleware(['auth', 'verified'])->name('question-update');

Route::get('/bible', [BibleController::class, 'index']);
Route::get('/bible/getTotalVerse/{passage}/{chapter}', [BibleController::class, 'getTotalVerse']);

Route::get('/test', function(){
        $user = User::find(Auth::id());

        dd(Auth::id());
});

Route::get('/json/postal_code', function(){
  return response()->file(public_path('json/postal_array.json'));
});

Route::get('/api/user_list', function(){
  return User::all();
});