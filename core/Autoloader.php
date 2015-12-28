<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 18.11.2015
 * Time: 22:00
 */
final class Autoloader
{
    private static $rootDir;


    public static function register($rootDir)
    {
        if ($rootDir !== null && is_string($rootDir))
        {
            self::$rootDir = $rootDir;
            spl_autoload_register(array("Autoloader", "autoload"));
        }else{
            die();
        }
    }

    public static function autoload($className)
    {
        if (is_dir(self::$rootDir))
        {
            if (!self::checkPath(self::$rootDir, $className))
            {
                self::checkSubDirectories(self::$rootDir, $className);
            }
        }
        else
        {
            die();
        }
    }

    /**
     * Checks if the given class exists in the path.
     * If it's exists, calls the according require_once function.
     *
     * @param $path String Path which should be checked.
     * @param $className String Name of the needed class.
     * @return bool True the class was found
     */
    private static function checkPath($path, $className)
    {
        $filePath = $path . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($filePath))
        {
            require_once($filePath);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Search in the sub directories of a directory for the needed class.
     * If the class was found it returns true otherwise it search recursivly
     * the next sub directories.
     * @param $directory Directory in which the sub directories are.
     * @param $className String Name of the needed class.
     * @return bool True if the class was found.
     */
    private static function checkSubDirectories($directory, $className)
    {
        if ($handle = opendir($directory))
        {
            while (($file = readdir($handle)))
            {
                if (self::isSubDirectory($directory, $file))
                {
                    $newDir = $directory . DIRECTORY_SEPARATOR . $file;

                    if (self::checkPath($newDir, $className))
                    {
                        return true;
                    }
                    else if (self::checkSubDirectories($newDir, $className))
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private static function isSubDirectory($directory, $file)
    {
        if (substr($file, 0, 1) !== ".")
        {
            $newDir = $directory . DIRECTORY_SEPARATOR . $file;

            if (is_dir($newDir))
            {
                return true;
            }
        }
        return false;
    }
}