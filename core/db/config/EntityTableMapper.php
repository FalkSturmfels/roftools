<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 13:26
 */
class EntityTableMapper
{
    private static $entityTableMap = array(
        "Attribute" => "attributes",
        "AttributeDef" => "attribute_defs"
    );

    /**
     * @inheritdoc
     */
    public static function getTableNameByEntityName($entityName)
    {
        if (is_string($entityName)) {
            if (array_key_exists($entityName, self::$entityTableMap)) {
                return self::$entityTableMap[$entityName];
            } else {
                throw new Exception("EntityName isn't mapped to an table name");
            }
        } else {
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }
}