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
}
