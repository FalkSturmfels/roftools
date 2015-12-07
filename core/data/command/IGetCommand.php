<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 22:59
 */
interface IGetCommand
{
    public function createGetRequest($entityName, array $columns = [], $propertyName = "", array $propertyValues = []);

    public function setSuccessFunction(CallbackFunction $successFunction);

    public function execute();

    // ============================================
    //
    //   Getter
    //
    // ============================================

    /**
     * @return String
     */
    public function getEntityName();

    /**
     * @return array
     */
    public function getColumns();

    /**
     * @return String
     */
    public function getPropertyName();

    /**
     * @return array
     */
    public function getPropertyValues();

    /**
     * @return CallbackFunction
     */
    public function getSuccessFunction();
}