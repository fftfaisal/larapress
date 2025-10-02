<?php

namespace Wordpress\Concerns;

use Thunder\Shortcode\Parser\ParserInterface;
use Thunder\Shortcode\ShortcodeFacade;

/**
 * Trait ShortcodesTrait
 *
 * @author Mickael Burguet <www.rundef.com>
 * @author Junior Grossi <juniorgro@gmail.com>
 */
trait Shortcodes
{
    /**
     * @var array
     */
    protected static $shortcodes = [];

    /** @var ParserInterface */
    private $shortcodeParser;

    /**
     * @param  string  $tag  the shortcode tag
     * @param  \Closure  $function  the shortcode handling function
     */
    public static function addShortcode($tag, $function)
    {
        self::$shortcodes[$tag] = $function;
    }

    /**
     * Removes a shortcode handler.
     *
     * @param  string  $tag  the shortcode tag
     */
    public static function removeShortcode($tag)
    {
        if (isset(self::$shortcodes[$tag])) {
            unset(self::$shortcodes[$tag]);
        }
    }

    /**
     * Change the default shortcode parser
     *
     * @return Shortcodes
     */
    public function setShortcodeParser(ParserInterface $parser): self
    {
        $this->shortcodeParser = $parser;

        return $this;
    }

    /**
     * Process the shortcodes.
     *
     * @param  string  $content  the content
     * @return string
     */
    public function stripShortcodes($content)
    {
        $handler = $this->getShortcodeHandlerInstance();

        $this->parseClassShortcodes($handler);
        $this->parseConfigShortcodes($handler);

        return $handler->process($content);
    }

    private function getShortcodeHandlerInstance(): ShortcodeFacade
    {
        return app()->make(ShortcodeFacade::class);
    }

    private function parseClassShortcodes(ShortcodeFacade $facade)
    {
        foreach (self::$shortcodes as $tag => $func) {
            $facade->addHandler($tag, $func);
        }
    }

    private function parseConfigShortcodes(ShortcodeFacade $facade)
    {
        $shortcodes = config('wordpress.shortcodes', []);
        foreach ($shortcodes as $tag => $class) {
            $facade->addHandler($tag, [new $class, 'render']);
        }
    }
}
