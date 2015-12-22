<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 02.12.2015
 * Time: 22:59
 */
class Bootstrap
{
    public static function boot($baseDir, $rootDomain)
    {
        self::mapCoreInstances();
        self::mapInstances();

        self::setConfig($baseDir);
    }

    private static function mapCoreInstances()
    {
        $context = new MappingContext();

        $context->mapInstance("IDbConnector", "DbConnectorMock", array("IDbConfig", "IEntityTableMapper"), true);
        //$context->mapInstance("IDbConnector", "DbConnector", array("IDbConfig", "IEntityTableMapper") , true);
        $context->mapInstance("IDbConfig", "DbConfig", null, true);
        $context->mapInstance("IEntityTableMapper", "EntityTableMapper", null, true);
        $context->mapInstance("IDataCommandExecutor", "DataCommandExecutor", array("IDbConnector"), true);
        $context->mapInstance("IGetCommand", "GetCommand", array("IDataCommandExecutor"), false);
        $context->mapInstance("IGenericFindService", "GenericFindService", array("Registry"), true);
        $context->mapInstance("IModuleMapper", "ModuleMapper", null, true);
        $context->mapInstance("IRouter", "Router", array("IModuleMapper"), true);

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

    private static function setConfig($baseDir)
    {
        $registry = Registry::getRegistryInstance();
        $configPath = $baseDir . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR;

        // Init DB-Config
        $dbConfig = $registry->getInstance("IDbConfig");
        $dbConfigFile = $configPath . "config_db.ini";
        $dbConfig->setConfigFile($dbConfigFile);

        // Init Entity-Table-Mapper
        $entityTableMapper = $registry->getInstance("IEntityTableMapper");
        $entityTableConfigFile = $configPath . "db_entity_table_map.ini";
        $entityTableMapper->setEntityTableMap($entityTableConfigFile);

        // Init Module-Mapper
        $moduleMapper = $registry->getInstance("IModuleMapper");
        $moduleMapFile = $configPath . "module_map.ini";
        $moduleMapper->setModuleMap($moduleMapFile);
    }

    private static function initRouter($rootDomain)
    {
        $registry = Registry::getRegistryInstance();

        $router = $registry->getInstance("IRouter");
        $router->setRootDomain($rootDomain);
    }
}