<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['content', 'description', 'is_required'];

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }
}
