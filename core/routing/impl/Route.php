<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 22.12.2015
 * Time: 20:07
 */
class Route implements IRoute
{
    private $controllerName;

    private $actionName;

    private $params;

    /**
     * Route constructor.
     * @param String $controllerName
     * @param String $actionName
     * @param array $params
     */
    public function __construct($controllerName, $actionName, $params)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->params = $params;
    }

    // ============================================
    //
    //   IRoute implementation
    //
    // ============================================


    /**
     * @return String
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return String
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}