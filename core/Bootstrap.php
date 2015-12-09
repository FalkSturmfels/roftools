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
        self::mapCoreInstances();
        self::mapInstances();

        self::setConfig($baseDir);
    }

    private static function setConfig($baseDir)
    {
        $registry = Registry::getRegistryInstance();
        $configPath = $baseDir . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR;

        $dbConfig = $registry->getInstance("IDbConfig");
        $dbConfigFile  = $configPath."config_db.ini";
        $dbConfig->setConfigFile($dbConfigFile);

        $entityTableMapper = $registry->getInstance("IEntityTableMapper");
        $entityTableConfigFile = $configPath."db_entity_table_map";
        $entityTableMapper->setEntityTable($entityTableConfigFile);
    }

    private static function mapCoreInstances()
    {
        $context = new MappingContext();

        //$context->mapInstance("IDbConnector", "DbConnectorMock", null, true);
        $context->mapInstance("IDbConnector", "DbConnector", array("IDbConfig", "IEntityTableMapper") , true);
        $context->mapInstance("IDbConfig", "DbConfig", null , true);
        $context->mapInstance("IEntityTableMapper", "EntityTableMapper", null , true);
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