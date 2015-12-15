<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 15.12.2015
 * Time: 22:00
 */

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 22:58
 */
interface IGenericFindService
{
    /**
     *
     * @param String $entityName
     * @param CallbackFunction $successFunction
     * @param array $attributeNames can be []
     * @param String $propertyName can be ""
     * @param array $propertyValues can be []
     *
     */
    public function findEntities($entityName, CallbackFunction $successFunction,
                                 array $attributeNames = [], $propertyName = "", array $propertyValues = []);
}