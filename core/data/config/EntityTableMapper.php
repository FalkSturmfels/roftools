<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 13:26
 */
class EntityTableMapper
{
    private $entityTableMap = array();
    private $propertyColumnMap = array();

    public function setEntityTableMap($file)
    {
        if ($map = parse_ini_file($file, TRUE)) {
            $entityTableMap = $map["entityTableMap"];

            $this->entityTableMap = array_merge($this->entityTableMap, $entityTableMap);
        }
    }

    public function setPropertyColumnMap($file)
    {
        if ($map = parse_ini_file($file, TRUE)) {
            $propertyColumnMap = $map["propertyColumnMap"];

            $this->entityTableMap = array_merge($this->propertyColumnMap, $propertyColumnMap);
        }
    }

    /**
     * @inheritdoc
     */
    public function getTableNameByEntityName($entityName)
    {
        if (is_string($entityName)) {
            if (array_key_exists($entityName, $this->entityTableMap)) {
                return $this->entityTableMap[$entityName];
            } else {
                throw new Exception("EntityName isn't mapped to an table name");
            }
        } else {
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }
}