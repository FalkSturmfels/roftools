<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 13:26
 */
class EntityTableMapper implements IEntityTableMapper
{
    private $entityTableMap = array();
    private $propertyColumnMap = array();

    public function setEntityTableMap($file)
    {
        if ($map = parse_ini_file($file, TRUE))
        {

            // Entity table map
            $entityTableMap = $map["entityTableMap"];

            $this->entityTableMap = array_merge($this->entityTableMap, $entityTableMap);

            // Property column map
            $propertyColumnMap = $map["propertyColumnMap"];

            $this->propertyColumnMap = array_merge($this->propertyColumnMap, $propertyColumnMap);
        }

    }

    /**
     * @inheritdoc
     */
    public function getTableNameByEntityName($entityName)
    {
        if (is_string($entityName))
        {
            if (array_key_exists($entityName, $this->entityTableMap))
            {
                return $this->entityTableMap[$entityName];
            }
            else
            {
                throw new Exception("EntityName isn't mapped to an table name");
            }
        }
        else
        {
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }

    public function getColumnNameByPropertyName($entityName, $propertyName)
    {
        if (is_string($entityName))
        {
            if (is_string($propertyName))
            {
                $key = $entityName . "." . $propertyName;

                if (array_key_exists($key, $this->propertyColumnMap))
                {
                    return $this->propertyColumnMap[$key];
                }
                else
                {
                    return $propertyName;
                }
            }
            else
            {
                throw new InvalidArgumentException("PropertyName must be a String");
            }
        }
        else
        {
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }
}