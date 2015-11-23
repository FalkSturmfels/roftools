<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 22:58
 */
class GenericFindService implements IDbCallbackHandler
{
    private $dbCommandExecutor;

    /**
     * GenericFindService constructor.
     * @param IDBCommandExecutor $dbCommandExecutor
     */
    public function __construct(IDbCommandExecutor $dbCommandExecutor)
    {
        $this->dbCommandExecutor = $dbCommandExecutor;
    }

    /**
     * @param IDbCallbackHandler $handler
     * @param $entityName
     * @param array $attributeNames
     * @param string $propertyName
     * @param array $propertyValues
     */
    public function findEntities(IDbCallbackHandler $handler, $entityName, array $attributeNames = [],
                               $propertyName = "", array $propertyValues = [])
    {
        if (is_string($entityName)) {
            $command = new GetCommand();
            $command->createGetQuery($entityName, $attributeNames, $propertyName, $propertyValues);
            $command->setCallbackHandler($handler);
            $this->dbCommandExecutor->execQueryCommand($command);
        }
        else{
            throw new InvalidArgumentException("EntityName must be a String");
        }
    }

    // ============================================
    //
    //   IDbCallbackHandler implementation
    //
    // ============================================

    public function setResult(array $result)
    {
        echo var_dump($result);
    }

    public function setReturnValue($returnValue)
    {
        echo print_r($returnValue);
    }


}