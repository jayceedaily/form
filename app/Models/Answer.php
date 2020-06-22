<?php

namespace App\Models;

class Answer extends Model
{
    protected $fillable = ['question_id', 'content'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function sheet()
    {
        return $this->belongsTo('App\Models\Sheet');
    }

}
