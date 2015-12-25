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
        $parts = preg_split("#/#", $path);

        if(sizeof($parts)>=3)
        {
            // extract module
            $moduleName = $this->moduleMapper->getModuleNameByName($parts[0]);
        }
        else{
            throw new Exception("url path must at least three parts, but has ".sizeof($parts));
        }

    }
}