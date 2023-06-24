<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    /*  default values
     *  protected $table = 'posts';
     *  protected $primaryKey = 'id';
     * */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'content'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
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

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
