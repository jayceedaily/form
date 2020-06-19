<?php

namespace App\Models;

class Question extends Model
{
    protected $fillable = ['content', 'description', 'is_required', 'order_number'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question)
        {
            if($question->order_number == null) {

                $question->order_number = $question->form->questions()->count() + 1;
            } else {

                $questions = self::where('order_number', '>=', $question->order_number)
                                 ->orderBy('order_number', 'ASC')
                                 ->get();

                $new_order_number = $question->order_number + 1;

                foreach ($questions as $_question) {

                    $_question->order_number = $new_order_number;

                    $_question->update();

                    $new_order_number++;
                }
            }
        });
    }

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    public function form()
    {
        return $this->belongsTo('app\Models\Form');
    }


}
