<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


//    For one-to-one relationship
    public function post() {
//      By default, second argument is considered as user_id. But in this case I am going to pass the arg anyway.
        return $this->hasOne("App\Models\Post", "user_id");
    }

//    For many-to-one relationship
    public function posts() {
        return $this->hasMany("App\Models\Post");
    }

    public function roles() {
        return $this->belongsToMany("App\Models\Role")->withPivot("created_at");
    }

//    Format
//    public function image(): MorphOne
//    {
//        return $this->morphOne(Image::class, 'imageable');
//    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }
}
