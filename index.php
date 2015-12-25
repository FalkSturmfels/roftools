<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 22.12.2015
 * Time: 20:28
 */
require_once "core/Autoloader.php";

$baseDir = dirname(__FILE__);
$rootDirectory = "/roftools/";
Autoloader::register($baseDir);
CoreBootstrap::boot($baseDir, $rootDirectory);
MainBootstrap::boot();

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = str_replace($rootDirectory, "", $path);


$registry = Registry::getRegistryInstance();

$frontController = $registry->getInstance("IFrontController");

$frontController->dispatch($path);
