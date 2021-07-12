<?php
namespace App\Models\Traits;

use Exception;
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
    public function scopeSort(Builder $query, Array $sort)
    {
        if(!$this->sort) {
            throw new Exception("No column configured to be sorted");
        }

        foreach($this->sort as $sortable) {

            if(in_array($sortable, array_keys($sort))) {

                $sortables = explode('.', $sortable);

                if( in_array(strtoupper($sort[$sortable]), ['DESC', 'ASC'])) {
                    $this->createSortQuery($query, $sortables, $sort[$sortable]);
                }
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

            $query->orderBy($sortColumn, $value);
        }
    }
}
