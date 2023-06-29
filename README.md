# Laravel
Too much fun
## Used Commands
### For global installer
```
composer global require laravel/installer
```
### Creating project
```
laravel new example-app
```
### Run laravel
```
php artisan serve
```
### Create a controller with template
```
php artisan make:controller --resource PostsController
```
# Problem solve - 1
use this syntax on laravel 10
```
Route::get('/post', [PostsController::class, 'index']);
```
instead using this(only supported by older version of laravel)
```
Route::get('/post', 'PostsController@index');
```

### Create migration file by commands
```
php artisan make:migration create_posts_table --create="posts"
```

### Rollback command(goes back to previous state)
```
php artisan migrate:rollback
```

### For adding new column create a new migrate file by this command
```
php artisan make:migration add_is_admin_to_posts_table --table="posts"
```
"posts" is the name of the table, Then add this code to the up function
```php
Schema::table('posts', function (Blueprint $table) {
    $table->tinyInteger("is_admin")->default(0)->unsigned();
});
```

## Raw SQL query in laravel
Goto "MyApp/routes/web.php" and create new routes like this:
```php
Route::get('/insert', function () {
    DB::insert('insert into posts (title, content) values (?, ?)', ["This is manual query", "I am awesome"]);
});
```
```php
Route::get("/view", function (){
   $response = DB::select("select * from posts where true");
   $rendering_content = "";
    for ($i = 0; $i < count($response); $i++) {
        $rendering_content .= $response[$i]->title." ".$response[$i]->content." ".$i.", ";
   }
   return $rendering_content;
});
```

```php
Route::get("/update", function (){
   $updated_value = DB::update('update posts set title ="What\'s up  bro updated" where id=?', [3]);
   return $updated_value;
});
```

```php
Route::get("/delete", function (){
    $deleted = DB::delete('delete from posts where id=?', [3]);
    return $deleted;
});
```

## Create model class command
```
php artisan make:model Post
```
Here, "Post" is the name of the model, in this file by default "posts" is the name of the table and "id" is the primary key. To also invoke a migration "-m" can be used like this:
```
php artisan make:model Post -m
```

## Note: by default laravel prevents allow mass assignment
Example:
```
Route::get("/create", function () {
    Post::create(['title'=> 'This is some title', 'content'=>'This is created by create method, where multiple column of entry gets created at ones.']);
});
```
Gives this error-
```
Illuminate \ Database \ Eloquent \ MassAssignmentException
```
To avoid this, add this code in "MyApp/app/Models/Post.php" in post class
```php
    protected $fillable = [
        'title',
        'content'
    ];
```
## For more details for eloquent relationship
```
https://laravel.com/docs/10.x/eloquent-relationships
```

## Tinker command:
### Tinker is used for testing without using route
### Initialize:
```
php artisan tinker
```
### Create an entry:
```php
App\Models\Post::create(['title'=>'Tinker Title', 'content'=> 'Tinker
 Content, testing']);
```
In this example entry is created in post table using Post model

### Creating an entry by creating object first
```php
$post = new App\Models\Post;
$post->title = 'This is a title from tinker';
$post->content = 'This is the content of manually created tinker post';
$post->save(); // adding to the table
```
Here each line is executed one by one through terminal
### Getting info
You can only get one first entry by 'first' function
```php
$post = App\Models\Post::whereId(7)->first(); // same as -> $post = App\Models\Post::where('id', 7)->first();
```
### Updating:
```php
$post = App\Models\Post::findOrFail(7);
$post->title = 'Updating tinker title that was created manually';
$post->content = 'Updated content, nothing else to say';
$post->save();
```
Here each line is executed one by one through terminal
### Deleting:
At first select what to delete
```php
$post = App\Models\Post::findOrFail(7);
```
For soft deleting, if we are using softDelete library
```php
$post->delete();
```
For force deleting an entry
```php
$post->forceDelete();
```
### Basically use as one would use eloquent query 

## Useful query
### Attach a role to a user or add an entry on pivot table
```php
App\Models\User::find(12)->roles()->attach(1);
```
Attach has a feature that allow duplicate entry, though id change but all other info remain same.
### Detach a role to a user or remove an entry on pivot table
```php
App\Models\User::find(12)->roles()->detach(1);
```
 Detach may delete multiple entry that was attached. Without argument it will delete all record in the table. 
 ### Sync method
 ```php
 App\Models\User::find(12)->roles()->sync([1]);
 ```
 It creates uniqe entry and deletes dupticates, multiple entry canbe placed by the elements of the argument array. For example:
 ```php
 App\Models\User::find(1)->roles()->sync([1, 2, 3]);
 ```