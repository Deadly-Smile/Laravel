<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\DB;

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

/*
|--------------------------------------------------------------------------
| Raw sql query
|--------------------------------------------------------------------------
*/
//Route::get('/insert', function () {
//    DB::insert('insert into posts (title, content) values (?, ?)', ["This is manual query", "I am awesome"]);
//});
//
//Route::get("/view", function (){
//   $response = DB::select("select * from posts where true");
//   $rendering_content = "";
//    for ($i = 0; $i < count($response); $i++) {
//        $rendering_content .= $response[$i]->title." ".$response[$i]->content." ".$i.", ";
//   }
//   return $rendering_content;
//});
//
//Route::get("/update", function (){
//   $updated_value = DB::update('update posts set title ="What\'s up  bro updated" where id=?', [3]);
//   return $updated_value;
//});
//
//Route::get("/delete", function (){
//    $deleted = DB::delete('delete from posts where id=?', [3]);
//    return $deleted;
//});

/*
|--------------------------------------------------------------------------
| ORM
|--------------------------------------------------------------------------
*/
Route::get("/read", function () {
   $posts = Post::all();
   foreach ($posts as $post) {
       return $post->title;
   }
});

Route::get("/find", function () {
    return Post::find(2);
});

//Route::get('/test', [PostsController::class, 'test']);

//Route::get('/{name}', function ($name) {
//    return "Well this guy ".$name.", is genius";
//});
