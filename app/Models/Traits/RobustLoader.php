<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use RuntimeException;
use InvalidArgumentException;

trait RobustLoader
{

    public function scopeRobust(Builder $query, Array $loader = [])
    {
        if(!$this->loaders || !$loader) {

            return;
        }

        foreach($this->loaders as $loaderable) {

            if(\in_array($loaderable, \array_values($loader))) {

                $query->with($loaderable);
            }
        }
    }
}
