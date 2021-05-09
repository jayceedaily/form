<?php

namespace App\Models;

use App\Models\Traits\HasFilters;
use App\Models\Traits\HasSearchable;
use App\Models\Traits\RobustLoader;

class Form extends Model
{
    use HasSearchable, HasFilters, RobustLoader;

    protected $searchable = [
        'questions.content',
        'author.name',
        'name'
    ];

    protected $loaders = [
        'author', 'sheets'
    ];

    protected $filters = [
        'author.id'
    ];

    protected $sort = [
        'author.id'
    ];

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

    public function scopeTraversify($query, $request)
    {
        if( $request->has('search') &&
            is_string($request->search)) {

            $query->search($request->search);
        }

        if( $request->has('filter') &&
            is_array($request->filter)) {

            $query->filter($request->filter);
        }

        if( $request->has('sort') &&
            is_array($request->sort)) {

            $query->filter($request->filter);
        }

        if( $request->has('load') &&
            is_array($request->load)) {

            $query->robust($request->load);
        }
    }
}
