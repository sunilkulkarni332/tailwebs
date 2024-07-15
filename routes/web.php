<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;

/** 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
**/

Route::group(['middleware' => ['auth', 'web']], function() {
    // Route::get('/dashboard', [UserController::class, 'homeScreen'])->name('homeScreen');    
    Route::get('/teacher/studentList', [StudentController::class, 'index'])->name('home');  
    Route::post('/teacher/studentInsert', [StudentController::class, 'studentInsert'])->name('studentInsert');    
    Route::post('/teacher/studentUpdate', [StudentController::class, 'studentUpdate'])->name('studentUpdate');    
    Route::get('/teacher/studentDelete/{id}', [StudentController::class, 'studentDelete'])->name('studentDelete');            
});
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
