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
        $context->mapInstance("IDataCommandExecutor", "DataCommandExecutor", array("IDbConnector"), true);
        $context->mapInstance("IGetCommand", "GetCommand", array("IDataCommandExecutor"), false);
        $context->mapInstance("IGenericFindService", "GenericFindService", array("Registry"), true);

        $registry = Registry::getRegistryInstance();
        $registry->addMappingContext($context);
    }

    private static function mapInstances()
    {
        $context = new MappingContext();

        $context->mapInstance("IAttributeDefFactory", "AttributeDefFactory", null, true);
        $context->mapInstance("IAttributeDefModel", "AttributeDefModel", array("IAttributeDefService"), true);
        $context->mapInstance("IAttributeDefService", "AttributeDefService",
            array("IGenericFindService", "IAttributeDefFactory"), true);

        $registry = Registry::getRegistryInstance();
        $registry->addMappingContext($context);
    }

}