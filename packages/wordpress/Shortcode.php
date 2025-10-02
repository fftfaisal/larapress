<?php

namespace Wordpress;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Interface Shortcode
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
interface Shortcode
{
    /**
     * @return string
     */
    public function render(ShortcodeInterface $shortcode);
}
