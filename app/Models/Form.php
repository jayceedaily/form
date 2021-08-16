<?php

namespace App\Models;


use Traversify\Traversable;
use App\Models\Traits\HasUuid;
use Traversify\Traversify;

class Form extends Model implements Traversable
{
    use HasUuid, Traversify;

    public $hasSearchRelationshipDriver = 'PowerJoin';

    protected $traversify = [

        'search' => [
            'name',
            'author.name',
        ],

        'autoload' => [
            'author', 'sheets'
        ],

        'filters' => [
            'author.id'
        ],

        'sort' => [
            'name',
            'author.name',
            'created_at',
        ]
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

}
