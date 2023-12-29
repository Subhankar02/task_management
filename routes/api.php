<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;

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


Route::group(['middleware' => ['auth:sanctum']], function (){
});


Route::post('/add/task',                    [TaskController::Class, 'add_task']);
Route::get('/get/users',                    [TaskController::Class, 'get_users']);
Route::get('/get/tasks/{task_id}',          [TaskController::Class, 'get_tasks']);
Route::get('/get/a_task/{task_id}',         [TaskController::Class, 'get_a_task']);
Route::get('/delete/task/{task_id}',        [TaskController::Class, 'delete_task']);
Route::post('/update/task',                 [TaskController::Class, 'update_task']);
