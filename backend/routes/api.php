<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReferencesController;
use App\Http\Controllers\Admin\SystemController;
// use App\Http\Controllers\FrontuserController;
use App\Http\Controllers\Api\Assigment\AssigmentController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\Payment\DocumnetController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\QuizzeController;
use App\Http\Controllers\Api\Calendar\CalendarController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\Api\SubmiteController;
use App\Http\Controllers\Front\FrontuserController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\ScoreController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});







// public routes
Route::post('/register', [FrontuserController::class, 'register']);
// user login
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/login', [AuthController::class, 'loginadmin']);
Route::post('/login', [FrontuserController::class, 'login']);

Route::post('/admin/login', [AuthController::class, 'login']); // admin login



// protected routes
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/me', [AuthController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/systems', [SystemController::class, 'index']);
    });
    Route::resource('/course', CourseController::class);

    //subject
    Route::resource('/subject', SubjectController::class);

    // assignment
    Route::prefix('assigment')->group(function () {
        Route::get('/list', [AssigmentController::class, 'index']);
        Route::post('/create', [AssigmentController::class, 'store']);
        Route::get('/show/{id}', [AssigmentController::class, 'show']);
        Route::put('/update/{id}', [AssigmentController::class, 'update']);
        Route::delete('/{id}', [AssigmentController::class, 'destroy']);
    });

    // system routes
    Route::prefix('system')->group(function () {
        Route::resource('/', SystemController::class);
    });

    // category routes
    Route::get('/category/list', [CategoryController::class, 'index']);
    Route::post('/category/create', [CategoryController::class, 'store']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::put('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    //classroom
    Route::resource('/classroom', ClassroomController::class);

    //documents
    Route::prefix('/document')->group(function () {
        Route::get('/list', [DocumnetController::class, 'index']);
        Route::post('/create', [DocumnetController::class, 'store']);
        Route::get('/show/{id}', [DocumnetController::class, 'show']);
        Route::put('/update/{id}', [DocumnetController::class, 'update']);
        Route::delete('/delete/{id}', [DocumnetController::class, 'destroy']);
    });
    //references   
    Route::prefix('/references')->group(function () {
        Route::get('/list', [ReferencesController::class, 'index']);
        Route::post('/create', [ReferencesController::class, 'store']);
        Route::get('/show/{id}', [ReferencesController::class, 'show']);
        Route::put('/update/{id}', [ReferencesController::class, 'update']);
        Route::delete('/delete/{id}', [ReferencesController::class, 'destroy']);
    });
    //payments  
    Route::prefix('/payment')->group(function () {
        Route::get('/list', [PaymentController::class, 'index']);
        Route::post('/create', [PaymentController::class, 'store']);
        Route::get('/show/{id}', [PaymentController::class, 'show']);
        Route::put('/update/{id}', [PaymentController::class, 'update']);
        Route::delete('/delete/{id}', [PaymentController::class, 'destroy']);
    });
    //books
    Route::resource('books', BookController::class);

    //calendar
    Route::resource('/calendar', CalendarController::class);

    Route::get('/notification/list', [NotificationController::class, 'index']);
    Route::post('/notification/create', [NotificationController::class, 'store']);
    Route::get('/notification/{id}', [NotificationController::class, 'show']);
    Route::put('/notification/update/{id}', [NotificationController::class, 'update']);
    Route::delete('/notification/delete/{id}', [NotificationController::class, 'destroy']);
});
            
    Route::resource('/favorites',FavoriteController::class);

//course
Route::resource('/course', CourseController::class);

//subject
Route::resource('/subject', SubjectController::class);
//comments
Route::resource('/comment', CommentController::class);
//score
Route::resource('/score', ScoreController::class);

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// assignment
Route::prefix('assigment')->group(function () {
    Route::get('/list', [AssigmentController::class, 'index']);
    Route::post('/create', [AssigmentController::class, 'store']);
    Route::get('/show/{id}', [AssigmentController::class, 'show']);
    Route::put('/update/{id}', [AssigmentController::class, 'update']);
    Route::delete('/{id}', [AssigmentController::class, 'destroy']);
});

//classroom
Route::resource('/classroom', ClassroomController::class);

//documents
// Route::post('/documents',[DocumentCon])
//books
Route::resource('books', BookController::class);

//calendar
Route::resource('/calendar', CalendarController::class);

//Notifications
Route::get('/notification/list', [NotificationController::class, 'index']);
Route::post('notification/create', [NotificationController::class, 'store']);
Route::get('notification/{id}', [NotificationController::class, 'show']);
Route::put('notification/update/{id}', [NotificationController::class, 'update']);
Route::delete('notification/delete/{id}', [NotificationController::class, 'destroy']);

//Quize
Route::get('/quizze/list', [QuizzeController::class, 'index']);
Route::post('/quizze/create', [QuizzeController::class, 'store']);
Route::get('/quizze/show/{id}', [QuizzeController::class, 'show']);
Route::put('/quizze/update/{id}', [QuizzeController::class, 'update']);
Route::delete('/quizze/delete/{id}', [QuizzeController::class, 'destroy']);

//submit
Route::get('/submite/list', [SubmiteController::class, 'index']);
Route::post('/submite/create', [SubmiteController::class, 'store']);
Route::get('/submite/show/{id}', [SubmiteController::class, 'show']);
Route::put('/submite/update/{id}', [SubmiteController::class, 'update']);
Route::delete('/submite/delete/{id}', [SubmiteController::class, 'destroy']);
