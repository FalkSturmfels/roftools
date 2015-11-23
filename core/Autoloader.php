<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 18.11.2015
 * Time: 22:00
 */
final class Autoloader
{

    private static $baseDir;

    private static $corePaths = array(
        "db",
        "db/command",
        "db/connect",
        "db/interfaces",
        "templateengine"
    );

    public static function register()
    {
        spl_autoload_register(array("Autoloader", "load"));
    }


    public static function addClassPaths(array $classPaths)
    {
        array_merge(self::$corePaths, $classPaths);
    }

    public static function load($className)
    {
        if (self::$baseDir === null) {
            self::$baseDir = dirname(__FILE__);
        }

        foreach (self::$corePaths as $corePath) {
            $filePath = self::$baseDir . DIRECTORY_SEPARATOR . $corePath . DIRECTORY_SEPARATOR . $className . '.php';
            if (file_exists($filePath)) {
                require_once($filePath);
                return;
            }
        }
    }


    /**
     * Singleton: private __construct
     *            private __clone
     */
    private function __construct()
    {
    }

    private function __clone()
    {
    }
}