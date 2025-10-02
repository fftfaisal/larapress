<?php

namespace Wordpress\Model\Meta;

use Exception;
use Wordpress\Model;
use Wordpress\Model\Collection\MetaCollection;

/**
 * Class Meta
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
abstract class Meta extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'meta_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $appends = ['value'];

    /**
     * @return mixed
     */
    public function getValueAttribute()
    {
        try {
            $value = unserialize($this->meta_value);

            return $value === false && $this->meta_value !== false ?
                $this->meta_value :
                $value;
        } catch (Exception $ex) {
            return $this->meta_value;
        }
    }

    /**
     * @return MetaCollection
     */
    public function newCollection(array $models = [])
    {
        return new MetaCollection($models);
    }
}
