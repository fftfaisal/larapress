<?php

namespace Wordpress;

use Illuminate\Contracts\Foundation\Application;

/**
 * Class Wordpress
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Wordpress
{
    public static function isLaravel(): bool
    {
        return function_exists('app') && (
            app() instanceof Application ||
            strpos(app()->version(), 'Lumen') === 0
        );
    }
}
