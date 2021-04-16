<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use RuntimeException;
use InvalidArgumentException;

trait HasSearchable
{
    /**
     * Initialize search query
     *
     * @param Builder $query
     * @param string|null $keyword
     * @return void
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function scopeSearch(Builder $query, String $keyword = null)
    {
        if(!$this->searchable || !$keyword) {
            return;
        }

        foreach($this->searchable as $searchable) {

            $searchables = explode('.', $searchable);

            $this->createSearchQuery($query, $searchables, $keyword);
        }
    }

    /**
     * Generate search query
     *
     * @param Builder $query
     * @param array $searchable
     * @param string $keyword
     * @return void
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    private function createSearchQuery(Builder $query, Array $searchable, String $keyword)
    {
        $searchColumn = array_shift($searchable);

        if(count($searchable)) {

            $query->orWhereHas($searchColumn, function($_query) use ($searchable, $keyword) {

                $_query->where(function($_query) use ($searchable, $keyword) {

                    $this->createSearchQuery($_query, $searchable, $keyword);
                });
            });

        } else {

            $query->orWhere(function($_query) use ($searchColumn, $keyword) {

                $_query->orWhere($searchColumn, 'LIKE', "%$keyword" );

                $_query->orWhere($searchColumn, 'LIKE', "$keyword%" );
            });
        }
    }
}
