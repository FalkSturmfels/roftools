<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 22:59
 */
class GetCommand implements IGetCommand
{
    private $entityName;

    private $columns;

    private $propertyName;

    private $propertyValues;

    private $dataCommandExecutor;

    private $successFunction;

    public function __construct(IDataCommandExecutor $dbCommandExecutor)
    {
        $this->dataCommandExecutor = $dbCommandExecutor;
    }

    // ============================================
    //
    //   IGetCommand implementation
    //
    // ============================================

    /**
     * Creates a get query
     * @param $entityName
     * @param array $columns
     * @param string $propertyName
     * @param array $propertyValues
     */
    public function createGetRequest($entityName, array $columns = [], $propertyName = "", array $propertyValues = [])
    {
        $this->$entityName = $entityName;
        $this->columns = $columns;
        $this->propertyName = $propertyName;
        $this->propertyValues = $propertyValues;
    }

    /**
     * @inheritdoc
     */
    public function setSuccessFunction(CallbackFunction $successFunction)
    {
        $this->successFunction = $successFunction;
    }

    public function execute()
    {
        $this->dataCommandExecutor->execGetRequest($this);
    }

    /**
     * @return String
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return mixed
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return mixed
     */
    public function getPropertyValues()
    {
        return $this->propertyValues;
    }

    /**
     * @return mixed
     */
    public function getSuccessFunction()
    {
        return $this->successFunction;
    }


}