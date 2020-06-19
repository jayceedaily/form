<?php

namespace App\Models;

class Sheet extends Model
{
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
}
