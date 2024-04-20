<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    use HasFactory;

    protected $table = 'polls';

    protected $guarded = [];

    // questions
    public function Question ()
    {
        return $this->hasMany(Question::class, 'pollId','id');
    }

    // creator id
    public function creator()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
