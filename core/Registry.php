<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 01.12.2015
 * Time: 12:41
 */
class Registry
{
    private $classMap = array();

    private $constructorArgsMap = array();

    private $singletonList = array();

    private $instanceMap = array();

    public function mapInstance($interfaceName, $className, $paramNames, $isSingleton)
    {
        if (!array_key_exists($interfaceName, $this->classMap))
        {
            $this->classMap[$interfaceName] = $className;

            if (!empty($paramNames))
            {
                $this->constructorArgsMap[$interfaceName] = $paramNames;
            }

            if ($isSingleton)
            {
                array_push($this->singletonList, $interfaceName);
            }
        }
    }

    public function getInstance($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->instanceMap))
        {
            return $this->instanceMap[$interfaceName];
        }
        else
        {
            return $this->createInstance($interfaceName);
        }
    }

    private function createInstance($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->classMap))
        {
            $instance = $this->createNewInstance($interfaceName);

            $isSingleton = in_array($interfaceName, $this->singletonList);
            if ($isSingleton)
            {
                $this->instanceMap[$interfaceName] = $instance;
            }
            return $instance;
        }
        return null;
    }

    private function createNewInstance($interfaceName)
    {
        $className = $this->getClassName($interfaceName);
        if ($className !== null)
        {
            $paramNames = $this->getConstructorArgs($interfaceName);

            if ($paramNames !== null)
            {
                $params = array();
                foreach ($paramNames as $name)
                {
                    $tmpParam = $this->getInstance($name);
                    array_push($params, $tmpParam);
                }

                $reflection = new ReflectionClass($className);
                $instance = $reflection->newInstanceArgs($params);
            }
            else
            {
                $instance = new $className();
            }
            return $instance;
        }
        return null;
    }

    private function getClassName($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->classMap))
        {
            return $this->classMap[$interfaceName];
        }
        return null;
    }

    private function getConstructorArgs($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->constructorArgsMap))
        {
            return $this->constructorArgsMap[$interfaceName];
        }
        return null;
    }

    // ============================================
    //
    //   Singleton
    //
    // ============================================

    static private $registry = null;

    static public function getRegistryInstance()
    {
        if (null === self::$registry)
        {
            self::$registry = new self;
        }

        return self::$registry;
    }

    /**
     * Singleton: private __construct
     *            private __clone
     */
    private function __construct()
    {
    }

    private function __clone()
    {
    }
}