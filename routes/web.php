<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


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

// Route::get('/', function () {
//     return view('index');
// });
// Route::get('login', function () {
//     return view('userLogin');
// });

Route::group(['middleware' => ['auth:sanctum']], function (){
    
});
Route::get('/login/page',            [LoginController::Class, 'login_page'])->name('login');
Route::get('/index',                        [LoginController::Class, 'index_page']);
Route::get('/users',                        [LoginController::Class, 'users_page']);
Route::get('/tasks/for_users',              [LoginController::Class, 'tasks_for_users_page']);
