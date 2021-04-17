<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use RuntimeException;
use InvalidArgumentException;

trait HasSort
{
    /**
     * Initialize sorts
     *
     * @param Builder $query
     * @param array $sort
     * @return void
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function scopeSort(Builder $query, Array $sort = [])
    {
        if(!$this->sort || !$sort) {

            return;
        }

        foreach($this->sort as $sortable) {

            if(in_array($sortable, array_keys($sort))) {

                $sortables = explode('.', $sortable);

                $value = "DESC";

                if( strtoupper($sort[$sortable]) == "ASC" ) {
                    $value = "ASC";
                }

                $this->createSortQuery($query, $sortables, $value);
            }
        }
    }

    /**
     * Generate sort query
     *
     * @param Builder $query
     * @param array $sortables
     * @param string $value
     * @return void
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    private function createSortQuery(Builder $query, Array $sortables, String $value)
    {
        $sortColumn = array_shift($sortables);

        if(count($sortables)) {

            $query->whereHas($sortColumn, function($_query) use ($sortables, $value) {

                $this->createSortQuery($_query, $sortables, $value);
            });

        } else {

            $query->where($sortColumn, $value);
        }
    }
}
