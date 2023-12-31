<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit787ed789c7d5bcc73502b598988d275a
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            's9e\\TextFormatter\\' => 18,
            's9e\\SweetDOM\\' => 13,
            's9e\\RegexpBuilder\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        's9e\\TextFormatter\\' => 
        array (
            0 => __DIR__ . '/..' . '/s9e/text-formatter/src',
        ),
        's9e\\SweetDOM\\' => 
        array (
            0 => __DIR__ . '/..' . '/s9e/sweetdom/src',
        ),
        's9e\\RegexpBuilder\\' => 
        array (
            0 => __DIR__ . '/..' . '/s9e/regexp-builder/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit787ed789c7d5bcc73502b598988d275a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit787ed789c7d5bcc73502b598988d275a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit787ed789c7d5bcc73502b598988d275a::$classMap;

        }, null, ClassLoader::class);
    }
}
