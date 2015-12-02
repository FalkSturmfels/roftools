<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 02.12.2015
 * Time: 22:59
 */
class Bootstrap
{
    public static function boot($baseDir)
    {
        self::setConfig($baseDir);
        self::mapCoreInstances();
        self::mapInstances();
    }

    private static function setConfig($baseDir)
    {
        $configPath = $baseDir . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR;
        DbConfig::setConfigFile($configPath . "config_db.ini");
    }

    private static function mapCoreInstances(){

        $registry = Registry::getRegistryInstance();

        $registry->mapInstance("IDbConnector", "DbConnector", null, true);
        $registry->mapInstance("IDbCommandExecutor", "DbCommandExecutor", array("IDbConnector"), true);
        $registry->mapInstance("IGetCommand", "GetCommand", null, false);
    }

    private static function mapInstances()
    {
        $registry = Registry::getRegistryInstance();

        $registry->mapInstance("IAttributeDefFactory", "AttributeDefFactory", null, true);
        $registry->mapInstance("IGenericFindService", "GenericFindService", array("IDbCommandExecutor"), true);
        $registry->mapInstance("IAttributeDefModel", "AttributeDefModel", array("IGenericFindService"), true);
    }

}