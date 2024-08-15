<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function relationwithreplay(){
        return $this->hasMany(Comment::class,'parent_id','id');
    }
}
