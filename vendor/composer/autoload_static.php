<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit004e175fa8b0929e59906864d04202f7
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WhichBrowser\\' => 13,
        ),
        'P' => 
        array (
            'Psr\\Cache\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WhichBrowser\\' => 
        array (
            0 => __DIR__ . '/..' . '/whichbrowser/parser/src',
            1 => __DIR__ . '/..' . '/whichbrowser/parser/tests/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit004e175fa8b0929e59906864d04202f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit004e175fa8b0929e59906864d04202f7::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit004e175fa8b0929e59906864d04202f7::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}