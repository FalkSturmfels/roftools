<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 23:35
 */

//require_once "core/db/interfaces/IDbCommand.php";
//require_once "core/db/interfaces/IDbCommandExecutor.php";
//require_once "core/db/interfaces/IDbCallbackHandler.php";
//require_once "core/db/connect/DbConnector.php";
//require_once "core/db/connect/DbCommandExecutor.php";
//require_once "core/db/config/DbConfig.php";
//require_once "core/db/config/EntityTableMapper.php";
//require_once "core/db/command/GetCommand.php";
require_once "core/Autoloader.php";
//require_once "main/core/dtos/GlobalDto.php";
//require_once "main/core/dtos/AttributeDefDto.php";
//require_once "main/core/services/GenericFindService.php";
//require_once "main/core/factory/AttributeDefFactory.php";
//require_once "main/modules/admin/attributedef/model/AttributeDefModel.php";


/*$entityname = (new attributedefdto())->getentityname();

$command = new getcommand();
$command->creategetquery($entityname, ["name"]);
echo $command->getquery();*/

$baseDir = dirname(__FILE__);
Autoloader::register($baseDir);

$connector = new DbConnector();
//$executor = new DBCommandExecutor($connector);
//$service = new GenericFindService($executor);
//$model = new AttributeDefModel($service);

//var_dump($model->getAttributeDefs());