<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit21f229e22276b6a91ee2857b3da7a700
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit21f229e22276b6a91ee2857b3da7a700::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit21f229e22276b6a91ee2857b3da7a700::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit21f229e22276b6a91ee2857b3da7a700::$classMap;

        }, null, ClassLoader::class);
    }
}