<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 23:16
 */

class DbConnector
{

    private $host;

    private $dbname;

    private $pw;

    private $user;

    private $pdo;

    /**
     * DbExecutor constructor.
     */
    public function __construct()
    {
        $this->host = DbConfig::host;
        $this->dbname = DbConfig::dbName;
        $this->pw = DbConfig::pw;
        $this->user = DbConfig::user;

        try {
            $dsn = "mysql:host=" . $this->host . ";"
                . "dbname=" . $this->dbname . ";";

            $this->pdo = new PDO($dsn, $this->user, $this->pw);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            var_dump($e);
            die();
        }
    }

    public function executeQueryCommand(IDbCallbackHandler $callbackHandler, $query)
    {
        $result = $this->execQuery($query);
        $callbackHandler->setResult($result);
    }

    private function execQuery($query)
    {
        if (!is_string($query)) {
            die();
        } else {
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}