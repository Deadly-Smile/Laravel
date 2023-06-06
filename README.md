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
#### Problem solve - 1
use this syntax on laravel 10
```
Route::get('/post', [PostsController::class, 'index']);
```
instead using this(only supported by older version of laravel)
```
Route::get('/post', 'PostsController@index');
```
