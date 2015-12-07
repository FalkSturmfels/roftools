<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 22:58
 */
class GenericFindService
{

    private $registry;

    /**
     * GenericFindService constructor.
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }


    /**
     *
     * @param String $entityName
     * @param Callable $successFunction
     * @param array $attributeNames can be []
     * @param String $propertyName can be ""
     * @param array $propertyValues can be []
     *
     */
    public function findEntities($entityName, CallbackFunction $successFunction, array $attributeNames = [],
                                 $propertyName = "", array $propertyValues = [])
    {
        if (is_string($entityName)) {

            $command = $this->registry->getInstance("IGetCommand");
            $command->createGetRequest($entityName, $attributeNames, $propertyName, $propertyValues);
            $command->setSuccessFunction($successFunction);
            $command->execute();
        }
        else{
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }

}