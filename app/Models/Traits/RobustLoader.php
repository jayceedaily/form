<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use RuntimeException;
use InvalidArgumentException;

trait RobustLoader
{

    public function scopeRobust(Builder $query, Array $filter = [])
    {
        if(!$this->loaders || !$filter) {

            return;
        }

        foreach($this->loaders as $filterable) {

            if(in_array($filterable, array_keys($filter))) {

                $query->with($filterable);
            }
        }
    }
}
