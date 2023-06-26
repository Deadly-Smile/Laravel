<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

//    Format
//    public function imageable(): MorphTo
//    {
//        return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
//    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
