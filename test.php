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

$configPath = $baseDir . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR;
DbConfig::setConfigFile($configPath . "config_db.ini");

/*$connector = new DbConnector();
$executor = new DBCommandExecutor($connector);
$service = new GenericFindService($executor);
$model = new AttributeDefModel($service);*/

/*var_dump($model->getAttributeDefs());*/

$registry = new Registry();
/*$connector = $registry->getInstance("IGetCommand");
$connector2 = $registry->getInstance("IGetCommand");*/

$connector = $registry->getInstance("IDbCommandExecutor");
$connector2 = $registry->getInstance("IDbCommandExecutor");

var_dump($connector);
var_dump($connector2);

$registry->mapInstance("IAttributeDefFactory", "AttributeDefFactory", null, true);
$registry->mapInstance("IGenericFindService", "GenericFindService", array("IDbCommandExecutor"), true);

$factory = $registry->getInstance("IAttributeDefFactory");
$service = $registry->getInstance("IGenericFindService");

var_dump($factory);
var_dump($service);