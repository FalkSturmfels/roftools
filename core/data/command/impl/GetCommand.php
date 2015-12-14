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

    private $neededProperties;

    private $selectorPropertyName;

    private $selectorPropertyValues;

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
     * @param array $neededProperties
     * @param string $selectorPropertyName
     * @param array $selectorPropertyValues
     */
    public function createGetRequest($entityName, array $neededProperties = [], $selectorPropertyName = "", array $selectorPropertyValues = [])
    {
        $this->entityName = $entityName;
        $this->neededProperties = $neededProperties;
        $this->selectorPropertyName = $selectorPropertyName;
        $this->selectorPropertyValues = $selectorPropertyValues;
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
    public function getNeededProperties()
    {
        return $this->neededProperties;
    }

    /**
     * @return mixed
     */
    public function getSelectorPropertyName()
    {
        return $this->selectorPropertyName;
    }

    /**
     * @return mixed
     */
    public function getSelectorPropertyValues()
    {
        return $this->selectorPropertyValues;
    }

    /**
     * @return mixed
     */
    public function getSuccessFunction()
    {
        return $this->successFunction;
    }


}