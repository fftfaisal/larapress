<?php

namespace Wordpress\Model;

use Wordpress\Concerns\AdvancedCustomFields;
use Wordpress\Concerns\MetaFields;
use Wordpress\Model;

/**
 * Class Term.
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Term extends Model
{
    use AdvancedCustomFields;
    use MetaFields;

    /**
     * @var string
     */
    protected $table = 'terms';

    /**
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taxonomy()
    {
        return $this->hasOne(Taxonomy::class, 'term_id');
    }
}
