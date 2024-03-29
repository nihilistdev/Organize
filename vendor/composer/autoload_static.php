<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac4519e9c4ff4101f8c94d635a9e20d7
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitac4519e9c4ff4101f8c94d635a9e20d7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac4519e9c4ff4101f8c94d635a9e20d7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitac4519e9c4ff4101f8c94d635a9e20d7::$classMap;

        }, null, ClassLoader::class);
    }
}
