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

    private static $rootDir;

    private static $corePaths = array(
        "db",
        "db/command",
        "db/config",
        "db/connect",
        "db/interfaces",
        "templateengine"
    );

    public static function register($rootDir = null)
    {
        if ($rootDir !== null && is_string($rootDir)) {
            spl_autoload_register(array("Autoloader", "autoload"));
        } else {
            spl_autoload_register(array("Autoloader", "load"));
        }
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
            $filePath = self::$baseDir . DIRECTORY_SEPARATOR . $corePath;
            self::checkPath($filePath, $className);
        }
    }

    public static function autoload($className)
    {
        if (is_dir(self::$rootDir)) {

            if(!self::checkPath(self::$rootDir)){

            }

        } else {
            die();
        }
    }

    private static function checkPath($path, $className)
    {
        $filePath = $path . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
            return true;
        } else {
            return false;
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