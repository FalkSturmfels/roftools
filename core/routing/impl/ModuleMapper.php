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

    public function setModuleMap($file)
    {
        if ($map = parse_ini_file($file, TRUE))
        {
            // Module map
            $moduleMap = $map["modules"];

            $this->moduleMap = array_merge($this->moduleMap, $moduleMap);
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
}