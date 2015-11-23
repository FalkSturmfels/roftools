<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 22:59
 */
class GetCommand implements IDbCommand
{
    private $query;

    private $callbackHandler;

    /**
     * Creates a get query
     * @param $entityName
     * @param array $columns
     * @param string $propertyName
     * @param array $propertyValues
     */
    public function createGetQuery($entityName, array $columns = [], $propertyName = "", array $propertyValues = [])
    {
        if (is_string($entityName)) {

            $selectPart = $this->createSelectPart($columns);
            $tableName = $this->createTableName($entityName);
            $wherePart = $this->createWherePart($propertyName, $propertyValues);

            $this->query = $selectPart . $tableName . $wherePart;
        } else {
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }

    private function createSelectPart($columns)
    {
        $selectPart = "SELECT * ";

        if (!empty($columns)) {
            $selectPart = "SELECT ";

            foreach ($columns as $column) {
                if (is_string($column)) {
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

        if (!empty($propertyName) && !empty($propertyValues)) {
            if (is_string($propertyName)) {

                $wherePart .= " WHERE ";

                foreach ($propertyValues as $propertyValue) {
                    $wherePart .= $propertyName . "= '" . $propertyValue . "' OR ";
                }
                $wherePart = substr($wherePart, 0, strlen($wherePart) - 4);
            } else {
                throw new InvalidArgumentException("PropertyName must be a String");
            }
        }

        return $wherePart;
    }

    // ============================================
    //
    //   IDbCommand implementation
    //
    // ============================================

    /**
     * @inheritdoc
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @inheritdoc
     */
    public function setCallbackHandler(IDbCallbackHandler $handler)
    {
        $this->callbackHandler = $handler;
    }

    /**
     * @inheritdoc
     */
    public function getCallbackHandler()
    {
        return $this->callbackHandler;
    }


}