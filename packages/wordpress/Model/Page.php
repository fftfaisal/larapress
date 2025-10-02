<?php

namespace Wordpress\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Page
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Page extends Post
{
    /**
     * @var string
     */
    protected $postType = 'page';

    /**
     * @return mixed
     */
    public function scopeHome(Builder $query)
    {
        return $query
            ->where('ID', '=', Option::get('page_on_front'))
            ->limit(1);
    }
}
