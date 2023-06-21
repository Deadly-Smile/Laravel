<?php

use App\Models\Post;
use App\Models\User;
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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/post/{id}', [PostsController::class, 'index']);

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
//Route::get("/read", function () {
//   $posts = Post::all();
//   foreach ($posts as $post) {
//       return $post->title;
//   }
//});
//
//Route::get("/find", function () {
//    return Post::find(2);
//});
//
//Route::get("/findwhere", function () {
//    return Post::where('id', ">=",1)->orderBy('id', 'desc')->take(2)->get();
//});
//
//Route::get("/findmore", function () {
////    return Post::findOrFail(10);
//    return Post::where('id', '>', 50)->firstOrFail();
//});
//
//Route::get("/basicinsert", function () {
//    $post = new Post;
//
//    $post->title = "Title of post";
//    $post->content = "Content of post, it suppose to be long text. So, I am writing this useless staff. If you are still reading this then use must have a lot of free time. Instead of reading my useless content, read a good book, it may help you in future.";
//
//    $post->save();
//});
//
//Route::get("/basicupdate", function () {
//    $post = Post::find(2);
//    $post->title = "New updated title";
//    $post->content = "This is updated post content, and I am not going to write long.";
//    $post->save();
//});
//
//Route::get("/create", function () {
//    Post::create(['title'=> 'This is some title', 'content'=>'This is created by create method, where multiple column of entry gets created at ones.']);
//});
//
//Route::get("/update2", function () {
//    Post::where('id', 2)->where('is_admin', 0)->update(['title'=>"new title by update2", 'content'=>"Content"]);
//});
//
//Route::get("/delete", function (){
//    $posts = Post::find(5);
//    $posts->delete();
//    return "Deleted successfully";
//});
//
//Route::get("/delete2", function () {
////    Post::destroy([4]);
//    Post::where('id', 1)->delete();
//    return "Destroyed successfully";
//});
//
//// soft delete(store in trash bin, latter can be restored or delete
//Route::get("/softdelete", function () {
//    Post::find(2)->delete();
//});
//
//Route::get("/trashbin", function () {
//    return Post::onlyTrashed()->where('id', ">", 0)->get();
//
//    // does not work
////    return Post::where('deleted_at', true)->orderBy('id', 'desc');
//});
//
//Route::get("/restore", function () {
//    return Post::withTrashed()->where('id', ">", 0)->restore();
//});
//
//Route::get("/permanentdelete", function () {
//    return Post::withTrashed()->where('id', 2)->forceDelete();
//});

/*
|--------------------------------------------------------------------------
| ORM Relationship
|--------------------------------------------------------------------------
*/
// One-to-One relation / function name is "hasOne()"
Route::get("user/{id}/post", function ($id) {
    return User::find($id)->post;
});

// reverse One-to-One relationship / function name is "belongsTo()"
Route::get("post/{id}/user", function ($id) {
//    My attempt to get name of user who posted complexity if O(n^2) // may be
//    return User::find(Post::find($id)->user_id)->name;
//    To make this work add user function to Post model + it may be more efficient
    return Post::find($id)->user->name;
});

// one-to-many relationship / function name is "hasMany()"
Route::get("user/{id}/posts", function ($id) {
    return User::find($id)->posts;

});

Route::get("user/{id}/role", function ($id) {
//    return User::find($id)->roles;
    foreach (User::find($id)->roles as $role) {
        echo $role->name;
    }
});


//Route::get('/test', [PostsController::class, 'test']);

//Route::get('/{name}', function ($name) {
//    return "Well this guy ".$name.", is genius";
//});
