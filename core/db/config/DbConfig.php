<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 21:50
 */
class DbConfig
{
    public static $host;

    public static $dbName;

    public static $user;

    public static $pw;

    /**
     * @param $fileName
     */
    public static function setConfigFile($fileName)
    {
        if ($dbConfig = parse_ini_file($fileName))
        {
            self::$host = $dbConfig["host"];
            self::$dbName = $dbConfig["dbName"];
            self::$user = $dbConfig["user"];
            self::$pw = $dbConfig["pw"];
        }
    }

    /**
     * Singleton: private __construct
     *            private __clone
     */
    private
    function __construct()
    {
    }

    private
    function __clone()
    {
    }
}