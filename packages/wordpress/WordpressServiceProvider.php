<?php

namespace Wordpress;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\ShortcodeFacade;

/**
 * Class WordpressServiceProvider
 *
 * @author Mickael Burguet <www.rundef.com>
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class WordpressServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->publishConfigFile();
        $this->registerAuthProvider();
    }

    /**
     * @return void
     */
    private function publishConfigFile()
    {
        $this->publishes([
            __DIR__.'/config.php' => base_path('config/wordpress.php'),
        ]);
    }

    /**
     * @return void
     */
    private function registerAuthProvider()
    {
        Auth::provider('wordpress', function ($app, array $config) {
            return new AuthUserProvider($config);
        });
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShortcodeFacade::class, function () {
            return tap(new ShortcodeFacade, function (ShortcodeFacade $facade) {
                $parser_class = config('corcel.shortcode_parser', RegularParser::class);
                $facade->setParser(new $parser_class);
            });
        });
    }
}
