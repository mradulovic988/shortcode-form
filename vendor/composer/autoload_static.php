<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite738fd95a3e00d79f5fb831186cb1cf9
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite738fd95a3e00d79f5fb831186cb1cf9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite738fd95a3e00d79f5fb831186cb1cf9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
