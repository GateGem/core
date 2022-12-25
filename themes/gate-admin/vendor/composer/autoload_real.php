<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitadf643161b3dbc16bce8d5224cc5c475
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitadf643161b3dbc16bce8d5224cc5c475', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitadf643161b3dbc16bce8d5224cc5c475', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitadf643161b3dbc16bce8d5224cc5c475::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}