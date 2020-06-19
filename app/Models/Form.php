<?php

namespace App\Models;

class Form extends Model
{
    protected $fillable = ['name', 'description', 'has_random_questions'];

    public function questions()
    {
        return $this->hasMany('App\Models\Question')->orderBy('order_number', 'ASC');
    }

    public function randomized_questions()
    {
        return $this->hasMany('App\Models\Question')->inRandomOrder();

    }

    public function sheets()
    {
        return $this->hasMany('App\Models\Sheet');
    }
}
