<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 22.12.2015
 * Time: 20:28
 */
require_once "core/Autoloader.php";

$baseDir = dirname(__FILE__);
$rootDomain = "www.roft.de";
Autoloader::register($baseDir);
Bootstrap::boot($baseDir, $rootDomain);

$testUrl = "www.roft.de/masterHall/attributedef/addattribute";

$registry = Registry::getRegistryInstance();

$router = $registry->getInstance("IRouter");
$route = $router->getRoute($testUrl);

echo $route->getModuleName()."<br>";
echo $route->getControllerName()."<br>";
echo $route->getActionName()."<br>";
