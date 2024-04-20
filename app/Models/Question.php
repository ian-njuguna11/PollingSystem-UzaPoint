<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $guarded = [];

    function poll()
    {
        return $this->belongsTo(Polls::class, 'pollId', 'id');
    }

    function choice(){
        return $this->hasMany(Choices::class,'questionId','id');
    }

}
