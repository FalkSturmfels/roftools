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
    public function getNeededProperties();

    /**
     * @return String
     */
    public function getSelectorPropertyName();

    /**
     * @return array
     */
    public function getSelectorPropertyValues();

    /**
     * @return CallbackFunction
     */
    public function getSuccessFunction();
}