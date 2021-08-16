<?php

namespace App\Models;

use Traversify\Traversify;
use Traversify\Traversable;

class Question extends Model implements Traversable
{
    use Traversify;

    protected $traversify = [
        'search' => [
            'content',

        ],
        'autoload' => [
            'author', 'form.author'
        ],
    ];

    protected $fillable = ['content', 'description', 'is_required', 'order_number'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question)
        {
            if($question->order_number == null) {

                $question->order_number = $question->form->questions()->count() + 1;

            } else {

                $questions = $question->form->questions()->where('order_number', '>=', $question->order_number)
                                 ->orderBy('order_number', 'ASC')
                                 ->get();

                $new_order_number = $question->order_number + 1;

                foreach ($questions as $_question) {

                    $_question->order_number = $new_order_number;

                    $_question->update();

                    $new_order_number++;
                }
            }

            if($question->order_number == null) {
                $question->order_number = $question->form->questions()->count() + 1;
            }

            if($question->isDirty('order')) {

                $newOrder = $question->order;
                $oldOrder = $question->getOriginal('order');

                $direction = $newOrder > $oldOrder ? 'DOWN' : 'UP';

                if($direction === 'DOWN') {
                    self::where('order', '<=', $newOrder)
                        ->where('order', '>=', $oldOrder)
                        ->where('id', '!=', $question->id)
                        ->orderBy('order', 'DESC')
                        ->decrement('order');
                }

                if($direction === 'UP') {
                    self::where('order', '>=', $newOrder)
                        ->where('order', '<=', $oldOrder)
                        ->where('id', '!=', $question->id)
                        ->orderBy('order', 'ASC')
                        ->increment('order');
                }
            }

        });

        static::deleting(function($question){

            $questions = $question->form->questions()->where('order_number', '>', $question->order_number)
                                 ->orderBy('order_number', 'ASC')
                                 ->get();

            $new_order_number = $question->order_number;

            foreach ($questions as $_question) {

                $_question->order_number = $new_order_number;

                $_question->update();

                $new_order_number++;
            }
        });


    }

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    public function form()
    {
        return $this->belongsTo('App\Models\Form');
    }

    public function sheets()
    {
        return $this->hasMany('App\Models\Sheet');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

}
