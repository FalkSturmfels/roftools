<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 22.12.2015
 * Time: 12:41
 */
abstract class ModuleBase
{
    protected $contollerMap = array();

    protected $actionMap = array();

    public function executeRequest(array $controllerParts, CallbackFunction $redirectToMain = null)
    {
        $controllerPart = $controllerParts[0];
        $actionPart = $controllerParts[1];

        if (sizeof($controllerParts) > 2)
        {
            $params = $controllerParts[2];
        }
        else
        {
            $params = null;
        }

        $controllerName = $this->getControllerName($controllerPart);
        $actionName = $this->getActionName($actionPart);

        if ($controllerName !== "" && $actionName !== "")
        {
            $this->callActionInController($controllerName, $actionName, $params);
        }
        else
        {
            if (isset($redirectToMain))
            {
                $redirectToMain->executeCallback();
            }
        }
    }

    protected function callActionInController($controllerName, $actionName, $params)
    {
        $registry = Registry::getRegistryInstance();
        $controller = $registry->getInstance($controllerName);

        if ($controller)
        {
            $callBack = new CallbackFunction($controller, $actionName);
            $callBack->executeCallback($params);
        }
    }

    protected function getControllerName($controllerPart)
    {
        if (array_key_exists($controllerPart, $this->contollerMap))
        {
            return $this->contollerMap[$controllerPart];
        }
        else
        {
            return "";
        }
    }

    protected function getActionName($actionPart)
    {
        if (array_key_exists($actionPart, $this->actionMap))
        {
            return $this->actionMap[$actionPart];
        }
        else
        {
            return "";
        }
    }
}