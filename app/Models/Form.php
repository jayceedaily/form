<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['name', 'description'];

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function sheets()
    {
        return $this->hasMany('App\Models\Sheet');
    }
}
