<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 22:58
 */
class GenericFindService
{

    /**
     * @param Callable $callable
     * @param $entityName
     * @param array $attributeNames
     * @param string $propertyName
     * @param array $propertyValues
     */
    public function findEntities(Callable $callable, $entityName, array $attributeNames = [],
                               $propertyName = "", array $propertyValues = [])
    {
        if (is_string($entityName)) {

            $registry = Registry::getRegistryInstance();

            $command = $registry.getInstance("IGetCommand");
            $command->createGetQuery($entityName, $attributeNames, $propertyName, $propertyValues);
            $command->setSuccessFunction($callable);

        }
        else{
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }

}