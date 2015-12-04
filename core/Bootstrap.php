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

    private static function mapCoreInstances()
    {
        $context = new MappingContext();

        $context->mapInstance("IDbConnector", "DbConnectorMock", null, true);
        //$context->mapInstance("IDbConnector", "DbConnector", null, true);
        $context->mapInstance("IDbCommandExecutor", "DbCommandExecutor", array("IDbConnector"), true);
        $context->mapInstance("IGetCommand", "GetCommand", null, false);

        $registry = Registry::getRegistryInstance();
        $registry->addMappingContext($context);
    }

    private static function mapInstances()
    {
        $context = new MappingContext();

        $context->mapInstance("IAttributeDefFactory", "AttributeDefFactory", null, true);
        $context->mapInstance("IGenericFindService", "GenericFindService", array("IDbCommandExecutor"), true);
        $context->mapInstance("IAttributeDefModel", "AttributeDefModel", array("IGenericFindService"), true);

        $registry = Registry::getRegistryInstance();
        $registry->addMappingContext($context);
    }

}