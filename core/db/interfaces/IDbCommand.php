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

    public function setSuccessFunction(callable $successFunction);
}