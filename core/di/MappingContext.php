<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 03.12.2015
 * Time: 12:38
 */
class MappingContext
{
    private $classMap = array();

    private $constructorArgsMap = array();

    private $singletonList = array();

    private $instanceMap = array();

    public function mapInstance($interfaceName, $className, $paramNames, $isSingleton)
    {
        if (!array_key_exists($interfaceName, $this->classMap)) {
            $this->classMap[$interfaceName] = $className;

            if (!empty($paramNames)) {
                $this->constructorArgsMap[$interfaceName] = $paramNames;
            }

            if ($isSingleton) {
                array_push($this->singletonList, $interfaceName);
            }
        }
    }

    /**
     * @return array
     */
    public function getClassMap()
    {
        return $this->classMap;
    }

    /**
     * @return array
     */
    public function getConstructorArgsMap()
    {
        return $this->constructorArgsMap;
    }

    /**
     * @return array
     */
    public function getSingletonList()
    {
        return $this->singletonList;
    }


    /**
     * @return array
     */
    public function getInstanceMap()
    {
        return $this->instanceMap;
    }

}