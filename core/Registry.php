<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 01.12.2015
 * Time: 12:41
 */
class Registry
{

    private $classMap = array(
        "IDbConnector" => "DbConnector",
        "IDbCommandExecutor" => "DbCommandExecutor",
        "IGetCommand" => "GetCommand"
    );

    private $parameterMap = array(
        "IDbCommandExecutor" => array("IDbConnector")
    );

    private $singletonList = array(
        "IDbConnector",
        "IDbCommandExecutor",
    );

    private $instanceMap = array();

    public function mapInstance($interfaceName, $className, $paramNames, $isSingleton)
    {
        if (!array_key_exists($interfaceName, $this->classMap))
        {
            $this->classMap[$interfaceName] = $className;

            if (!empty($paramNames))
            {
                $this->parameterMap[$interfaceName] = $paramNames;
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
            $isSingleton = in_array($interfaceName, $this->singletonList);
            $instance = $this->createCoreInstance($interfaceName);

            if ($isSingleton)
            {
                $this->instanceMap[$interfaceName] = $instance;
            }
            return $instance;
        }
        return null;
    }

    private function createCoreInstance($interfaceName)
    {
        $className = $this->getCoreClass($interfaceName);
        if ($className !== null)
        {
            $paramNames = $this->getCoreParams($interfaceName);

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

    private function getCoreClass($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->classMap))
        {
            return $this->classMap[$interfaceName];
        }
        return null;
    }

    private function getCoreParams($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->parameterMap))
        {
            return $this->parameterMap[$interfaceName];
        }
        return null;
    }
}