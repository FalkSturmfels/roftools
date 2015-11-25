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

$connector = new DbConnector();
$executor = new DBCommandExecutor($connector);
$service = new GenericFindService($executor);
$model = new AttributeDefModel($service);

var_dump($model->getAttributeDefs());