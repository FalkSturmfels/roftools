<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 21:50
 */
class DbConfig
{
    private $host;

    private $dbName;

    private $user;

    private $pw;

    /**
     * @param $fileName
     */
    public function setConfigFile($fileName)
    {
        if ($dbConfig = parse_ini_file($fileName))
        {
            $this->host = $dbConfig["host"];
            $this->dbName = $dbConfig["dbName"];
            $this->user = $dbConfig["user"];
            $this->pw = $dbConfig["pw"];
        }
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPw()
    {
        return $this->pw;
    }
}