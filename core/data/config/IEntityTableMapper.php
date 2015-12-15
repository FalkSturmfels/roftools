<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 15.12.2015
 * Time: 21:54
 */

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 13:26
 */
interface IEntityTableMapper
{
    public function setEntityTableMap($file);

    /**
     * @inheritdoc
     */
    public function getTableNameByEntityName($entityName);

    public function getColumnNameByPropertyName($entityName, $propertyName);
}