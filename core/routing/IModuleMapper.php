<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 22.12.2015
 * Time: 12:45
 */
interface IModuleMapper
{
    public function setModuleMap($file);

    public function getModuleByName($moduleName);

    public function getControllerByName($controllerName);

    public function getActionByName($controllerName, $actionName);
}