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
        $parts = preg_split("#/#", $path, -1, PREG_SPLIT_NO_EMPTY);

        $partsLength = sizeof($parts);
        if ($partsLength >= 3)
        {
            // extract module
            $moduleName = $this->moduleMapper->getModuleNameByName($parts[0]);

            if ($moduleName)
            {
                $registry = Registry::getRegistryInstance();

                $module = $registry->getInstance($moduleName);
                if ($module)
                {
                    $redirectToMainCallback = new CallbackFunction($this, "redirectToMain");

                    $controllerParts = array_slice($parts, 1);

                    $module->executeRequest($controllerParts, $redirectToMainCallback);
                    return;
                }
            }
        }
        $this->redirectToMain();
    }

    /**
     * Redirect to the main page
     */
    public function redirectToMain()
    {
        echo "Redirect to main";
    }
}