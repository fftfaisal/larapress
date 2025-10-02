<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Wordpress Database Connection Name
    |--------------------------------------------------------------------------
    |
    | By default, Wordpress uses your default database connection, set on
    | `config/database.php` (`default` key). Usually you'd like to use a
    | custom database just for WordPress. First you must configure that
    | database connection in `config/database.php`, and then set here its
    | name, like 'wordpress', for example. Then you can work with two or more
    | database, but this one is only for your WordPress tables.
    |
    */

    'connection' => 'mysql',

    /*
    |--------------------------------------------------------------------------
    | Registered Custom Post Types
    |--------------------------------------------------------------------------
    |
    | WordPress allows you to create your own custom post types. Wordpress
    | makes querying posts using a custom post type easier, but here you can
    | set a list of your custom post types, and Wordpress will automatically
    | register all of them, making returning those custom classes, instead
    | of just Post objects.
    |
    */

    'post_types' => [
        //        'video' => App\Models\Video::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Registered Shortcodes
    |--------------------------------------------------------------------------
    |
    | With Wordpress you can register as many shortcodes you want, but that's
    | usually made in runtime. Here it's the place to set all your custom
    | shortcodes to make Wordpress registering all of them automatically. Just
    | create your own shortcode class implementing `Wordpress\Shortcode` interface.
    |
    */

    'shortcodes' => [
        //        'foo' => App\Shortcodes\FooShortcode::class,
    ],

];
