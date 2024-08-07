<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit977248ad7e3934e8fba82e5bd9789db2
{
    public static $files = array (
        'e39a8b23c42d4e1452234d762b03835a' => __DIR__ . '/..' . '/ramsey/uuid/src/functions.php',
        '43d34c2a8d40488b600f3f1bb9b3c46b' => __DIR__ . '/../..' . '/app/utilities/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
            'Ramsey\\Collection\\' => 18,
        ),
        'I' => 
        array (
            'Includes\\' => 9,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Ramsey\\Collection\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/collection/src',
        ),
        'Includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit977248ad7e3934e8fba82e5bd9789db2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit977248ad7e3934e8fba82e5bd9789db2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit977248ad7e3934e8fba82e5bd9789db2::$classMap;

        }, null, ClassLoader::class);
    }
}
