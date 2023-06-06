<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post/{id}', [PostsController::class, 'index']);

//Route::get('/test', [PostsController::class, 'test']);

//Route::get('/{name}', function ($name) {
//    return "Well this guy ".$name.", is genius";
//});
