<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 22.12.2015
 * Time: 19:32
 */
class ModuleMapper implements IModuleMapper
{
    private $moduleMap = array();

    private $controllersMap = array();

    private $actionsMap = array();

    public function setModuleMap($file)
    {
        if ($map = parse_ini_file($file, TRUE))
        {
            // Module map
            $moduleMap = $map["modules"];

            $this->moduleMap = array_merge($this->moduleMap, $moduleMap);

            // Controller map
            $controllerMap = $map["controllers"];

            $this->controllersMap = array_merge($this->controllersMap, $controllerMap);

            // Action map
            $actionsMap = $map["actions"];

            $this->actionsMap = array_merge($this->actionsMap, $actionsMap);
        }
    }


    public function getModuleNameByName($moduleName)
    {
        if (is_string($moduleName))
        {
            if (array_key_exists($moduleName, $this->moduleMap))
            {
                return $this->moduleMap[$moduleName];
            }
            else
            {
                return $moduleName;
            }
        }
        else
        {
            throw new InvalidArgumentException("ModuleName must be a String");
        }
    }

    public function getControllerNameByName($controllerName)
    {
        if (is_string($controllerName))
        {
            if (array_key_exists($controllerName, $this->controllersMap))
            {
                return $this->controllersMap[$controllerName];
            }
            else
            {
                return $controllerName;
            }
        }
        else
        {
            throw new InvalidArgumentException("ControllerName must be a String");
        }
    }

    public function getActionNameByName($controllerName, $actionName)
    {
        if (!is_string($controllerName))
        {
            throw new InvalidArgumentException("ControllerName must be a String");
        }
        if (!is_string($actionName))
        {
            throw new InvalidArgumentException("ActionName must be a String");
        }

        $actionKey = $controllerName.".".$actionName;

        if (array_key_exists($actionKey, $this->actionsMap))
        {
            return $this->actionsMap[$actionKey];
        }
        else
        {
            return $actionName;
        }

    }

}