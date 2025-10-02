<?php

namespace Wordpress\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait OrderedTrait
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
trait OrderScopes
{
    /**
     * @return Builder
     */
    public function scopeNewest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    /**
     * @return Builder
     */
    public function scopeOldest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'asc');
    }
}
