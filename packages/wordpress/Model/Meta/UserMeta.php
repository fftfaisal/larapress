<?php

namespace Wordpress\Model\Meta;

use Wordpress\Model\User;

/**
 * Class UserMeta
 *
 * @author Mickael Burguet <www.rundef.com>
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class UserMeta extends Meta
{
    /**
     * @var string
     */
    protected $table = 'usermeta';

    /**
     * @var string
     */
    protected $primaryKey = 'umeta_id';

    /**
     * @var array
     */
    protected $fillable = ['meta_key', 'meta_value', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
