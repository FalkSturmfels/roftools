<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 22.12.2015
 * Time: 20:17
 */
class Router implements IRouter
{

    private $rootDomain;

    private $moduleMapper;

    /**
     * Router constructor.
     * @param IModuleMapper $moduleMapper
     */
    public function __construct(IModuleMapper $moduleMapper)
    {
        $this->moduleMapper = $moduleMapper;
    }

    // ============================================
    //
    //   Getter & Setter
    //
    // ============================================

    /**
     * @param String $rootDomain
     */
    public function setRootDomain($rootDomain)
    {
        $this->rootDomain = $rootDomain;
    }

    // ============================================
    //
    //   IRouter implementation
    //
    // ============================================

    public function createRoute($url)
    {
        $controllerName = "Controller";
        $actionName = "Action";
        $params = array();

        $route = new Route($controllerName, $actionName, $params);

        return $route;
    }

}