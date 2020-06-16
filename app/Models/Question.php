<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['content', 'description', 'is_required', 'order_number'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question)
        {
            $question->order_number = $question->form->questions()->count()+1;
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
