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

    private $entityTableMapper;

    /**
     * DbConnector constructor.
     * @param DbConfig $dbConfig
     * @param EntityTableMapper $entityTableMapper
     */
    public function __construct(DbConfig $dbConfig, EntityTableMapper $entityTableMapper)
    {
        $this->host = $dbConfig->getHost();
        $this->dbname = $dbConfig->getDbName();
        $this->pw = $dbConfig->getPw();
        $this->user = $dbConfig->getUser();

        $this->entityTableMapper = $entityTableMapper;

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
        $neededProperties = $command->getNeededProperties();
        $propertyName = $command->getSelectorPropertyName();

        $propertyValues = $command->getSelectorPropertyValues();

        if (is_string($entityName))
        {
            $selectPart = $this->createSelectPart($entityName, $neededProperties);
            $tableName = $this->createTableName($entityName);
            $wherePart = $this->createWherePart($entityName, $propertyName, $propertyValues);

            $query = $selectPart . $tableName . $wherePart;

            if ($successFunction instanceof CallbackFunction)
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

    private function createSelectPart($entityName, $neededProperties)
    {
        $selectPart = "SELECT * ";

        if (!empty($neededProperties))
        {
            $selectPart = "SELECT ";

            foreach ($neededProperties as $neededProperty)
            {
                if (is_string($neededProperty))
                {
                    $columnName = $this->createColumnName($entityName, $neededProperty);
                    $selectPart .= $columnName . ", ";
                }
            }
            $selectPart = substr($selectPart, 0, strlen($selectPart) - 2) . " ";
        }

        $selectPart .= "FROM ";

        return $selectPart;
    }

    private function createTableName($entityName)
    {
        return $this->entityTableMapper->getTableNameByEntityName($entityName);
    }

    private function createColumnName($entityName, $propertyName)
    {
        return $this->$this->entityTableMapper->getColumnNameByPropertyName($entityName, $propertyName);
    }

    private function createWherePart($entityName, $propertyName, array $propertyValues)
    {
        $wherePart = "";

        if (!empty($propertyName) && !empty($propertyValues))
        {
            if (is_string($propertyName))
            {
                $columnName = $this->createColumnName($entityName, $propertyName);
                $wherePart .= " WHERE ";

                foreach ($propertyValues as $propertyValue)
                {
                    $wherePart .= $columnName . "= '" . $propertyValue . "' OR ";
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