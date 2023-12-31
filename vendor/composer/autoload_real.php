<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitdebfbd3e47081bdfa77994d5c69b8f91
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

        spl_autoload_register(array('ComposerAutoloaderInitdebfbd3e47081bdfa77994d5c69b8f91', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitdebfbd3e47081bdfa77994d5c69b8f91', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitdebfbd3e47081bdfa77994d5c69b8f91::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
