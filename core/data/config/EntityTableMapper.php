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

        if ($dbConfig = parse_ini_file($fileName))
        {

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