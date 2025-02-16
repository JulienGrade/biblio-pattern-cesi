<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1568c45ed3deeb5c458c7ab2734d6b56
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1568c45ed3deeb5c458c7ab2734d6b56::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1568c45ed3deeb5c458c7ab2734d6b56::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1568c45ed3deeb5c458c7ab2734d6b56::$classMap;

        }, null, ClassLoader::class);
    }
}
