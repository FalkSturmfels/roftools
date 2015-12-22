<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 22.12.2015
 * Time: 20:07
 */
class Route implements IRoute
{

    private $moduleName;

    private $controllerName;

    private $actionName;

    /**
     * Route constructor.
     * @param String $moduleName
     * @param String $controllerName
     * @param String $actionName
     */
    public function __construct($moduleName, $controllerName, $actionName)
    {
        $this->moduleName = $moduleName;
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    // ============================================
    //
    //   IRoute implementation
    //
    // ============================================

    /**
     * @return String
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

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

}