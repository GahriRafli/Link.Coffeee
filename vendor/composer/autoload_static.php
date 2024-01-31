<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite49857e1f8739f268868417c00ea53fe
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Midtrans\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Midtrans\\' => 
        array (
            0 => __DIR__ . '/..' . '/midtrans/midtrans-php/Midtrans',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite49857e1f8739f268868417c00ea53fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite49857e1f8739f268868417c00ea53fe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite49857e1f8739f268868417c00ea53fe::$classMap;

        }, null, ClassLoader::class);
    }
}
