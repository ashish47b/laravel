<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MenusController;

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
Route::get('/',[Login::class,'login']);
Route::get('/registration',[Login::class,'registration'])->name('Registration.html');
Route::get('/Forgot-Password',[Login::class,'forgotPassword']);
Route::post('/User-Register',[Login::class,'userRegister'])->name('User-Register');
Route::post('/User-Login',[Login::class,'userLogin'])->name('User-Login');

Route::group(['middleware'=>['checkUserLogin']],function(){
    Route::get('/Dashboard',[Dashboard::class,'dashboard']);
    Route::get('/Logout',[Dashboard::class,'logout']);
    Route::get('/menu',[MenusController::class,'index']);
    Route::post('/get-all-menu-list',[MenusController::class,'getallmenulist'])->name('get-all-menu-list');
    Route::post('/createMenu',[MenusController::class,'create']);

});
