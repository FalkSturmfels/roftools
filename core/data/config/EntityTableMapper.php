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

    public function setEntityTable($file){

        if ($map = parse_ini_file($file))
        {
            $entityTableMap = $map["entityTableMap"];

            $this->entityTableMap = array_merge($this->entityTableMap, $entityTableMap);
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