<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 23:35
 */


require_once "core/Autoloader.php";

$baseDir = dirname(__FILE__);
Autoloader::register($baseDir);
CoreBootstrap::boot($baseDir);
MainBootstrap::boot();

$registry = Registry::getRegistryInstance();

$model = $registry->getInstance("IAttributeDefModel");
var_dump($model->getAttributeDefs());