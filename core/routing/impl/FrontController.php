<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 25.12.2015
 * Time: 14:56
 */
class FrontController implements IFrontController
{
    private $moduleMapper;

    /**
     * FrontController constructor.
     * @param IModuleMapper $moduleMapper
     */
    public function __construct(IModuleMapper $moduleMapper)
    {
        $this->moduleMapper = $moduleMapper;
    }


    public function dispatch($path)
    {
        $parts = $this->extractModule($path);

        var_dump($parts);
    }

    /**
     * @param String $path Example:
     *  "/moduleName/controllerName/actionName/param1/param2"
     * @return array
     */
    private function extractModule($path)
    {
        return preg_split("#/#", $path);
    }
}