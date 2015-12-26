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
            $params = array_slice($controllerParts, 2);
        }
        else
        {
            $params = null;
        }

        $controllerName = $this->getControllerName($controllerPart);

        $actionName = $this->getActionName($controllerPart, $actionPart);

        $enoughParams = $this->hasEnoughParams($controllerPart, $actionPart, $params);

        if ($controllerName !== "" && $actionName !== "" && $enoughParams)
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

    protected function getActionName($controllerPart, $actionPart)
    {
        $actionName = "";

        $actionMapEntry = $this->getActionMapEntry($controllerPart, $actionPart);

        if (is_string($actionMapEntry))
        {
            $actionName = $actionMapEntry;
        }
        else if (is_array($actionMapEntry) && sizeof($actionMapEntry) == 2)
        {
            if (is_string($actionMapEntry[0]))
            {
                $actionName = $actionMapEntry[0];
            }
        }

        return $actionName;
    }

    private function hasEnoughParams($controllerPart, $actionPart, $params)
    {
        $requiredNumber = 0;
        $actionMapEntry = $this->getActionMapEntry($controllerPart, $actionPart);


        if (is_array($actionMapEntry) && sizeof($actionMapEntry) == 2)
        {
            $requiredNumber = $actionMapEntry[1];
        }

        return sizeof($params) == $requiredNumber;
    }

    private function getActionMapEntry($controllerPart, $actionPart)
    {
        if (array_key_exists($controllerPart, $this->actionMap))
        {
            $methodsMap = $this->actionMap[$controllerPart];
            if (array_key_exists($actionPart, $methodsMap))
            {
                return $methodsMap[$actionPart];
            }
        }

        return null;
    }
}