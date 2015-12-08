<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 23:16
 */
class DbConnector implements IDbConnector
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
        $this->host = DbConfig::$host;
        $this->dbname = DbConfig::$dbName;
        $this->pw = DbConfig::$pw;
        $this->user = DbConfig::$user;

        try
        {
            $dsn = "mysql:host=" . $this->host . ";"
                . "dbname=" . $this->dbname . ";";

            $this->pdo = new PDO($dsn, $this->user, $this->pw);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e)
        {
            var_dump($e);
            die();
        }
    }

    // ============================================
    //
    //   IDbConnector implementation
    //
    // ============================================

    public function executeGetCommand(IGetCommand $command)
    {
        $entityName = $command->getEntityName();
        $successFunction = $command->getSuccessFunction();
        $columns = $command->getNeededProperties();
        $propertyName = $command->getSelectorPropertyName();
        $propertyValues = $command->getSelectorPropertyValues();

        if (is_string($entityName))
        {
            $selectPart = $this->createSelectPart($columns);
            $tableName = $this->createTableName($entityName);
            $wherePart = $this->createWherePart($propertyName, $propertyValues);

            $query = $selectPart . $tableName . $wherePart;

            if (is_callable($successFunction))
            {
                $this->execQuery($query, $successFunction);
            }
            else
            {
                throw new InvalidArgumentException("SuccessFunction must be a Function");
            }
        }
        else
        {
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }

    private function execQuery($query, CallbackFunction $successFunction)
    {
        if (!is_string($query))
        {
            die();
        }
        else
        {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($successFunction instanceof CallbackFunction)
            {
                call_user_func($successFunction->getCallable(), $result);
            }
        }
    }

    // ============================================
    //
    //   Helper methods
    //
    // ============================================

    private function createSelectPart($columns)
    {
        $selectPart = "SELECT * ";

        if (!empty($columns))
        {
            $selectPart = "SELECT ";

            foreach ($columns as $column)
            {
                if (is_string($column))
                {
                    $selectPart .= $column . ", ";
                }
            }
            $selectPart = substr($selectPart, 0, strlen($selectPart) - 2) . " ";
        }

        $selectPart .= "FROM ";

        return $selectPart;
    }

    private function createTableName($entityName)
    {
        return EntityTableMapper::getTableNameByEntityName($entityName);
    }

    private function createWherePart($propertyName, array $propertyValues)
    {
        $wherePart = "";

        if (!empty($propertyName) && !empty($propertyValues))
        {
            if (is_string($propertyName))
            {

                $wherePart .= " WHERE ";

                foreach ($propertyValues as $propertyValue)
                {
                    $wherePart .= $propertyName . "= '" . $propertyValue . "' OR ";
                }
                $wherePart = substr($wherePart, 0, strlen($wherePart) - 4);
            }
            else
            {
                throw new InvalidArgumentException("PropertyName must be a String");
            }
        }

        return $wherePart;
    }
}