<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac42bdedcd486f9d1e31eaf0ecfdbb2a
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'DB' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
        'DBTransaction' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
        'MeekroDB' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
        'MeekroDBEval' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
        'MeekroDBException' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
        'MeekroDBWalk' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
        'WhereClause' => __DIR__ . '/..' . '/sergeytsalkov/meekrodb/db.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitac42bdedcd486f9d1e31eaf0ecfdbb2a::$classMap;

        }, null, ClassLoader::class);
    }
}
