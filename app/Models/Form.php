<?php

namespace App\Models;

use App\Models\Traits\HasSearchable;

class Form extends Model
{
    use HasSearchable;

    protected $searchable = [
        'questions.content',
        'author.name',
        'name'];

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
