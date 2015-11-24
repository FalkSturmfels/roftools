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
            if (self::checkPath($filePath, $className)) {
                break;
            }
        }
    }

    public static function autoload($className)
    {
        if (is_dir(self::$rootDir)) {

            if (!self::checkPath(self::$rootDir, $className)) {
                self::checkSubDirectories(self::$rootDir);
            }

        } else {
            die();
        }
    }

    /**
     * Checks if the given class exists in the path.
     * If it's exists, calls the according require_once function.
     *
     * @param $path Path which should be checked.
     * @param $className Name of the needed class.
     * @return bool True the class was found
     */
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
     * Search in the sub directories of a directory for the needed class.
     * If the class was found it returns true otherwise it search recursivly
     * the next sub directories.
     * @param $directory Directory in which the sub directories are.
     * @param $className Name of the needed class.
     * @return bool True if the class was found.
     */
    private static function checkSubDirectories($directory, $className)
    {
        if ($handle = opendir($directory)) {
            while (($file = readdir($handle)) !== false) {
                if (is_dir($file)) {
                    if (self::checkPath($file, $className)) {
                        return true;
                    } else {
                        if(self::checkSubDirectories($file, $className)){
                            return true;
                        }
                    }
                }
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