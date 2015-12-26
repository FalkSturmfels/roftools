<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 02.12.2015
 * Time: 22:59
 */
class CoreBootstrap
{
    private static $registry;

    public static function boot($baseDir)
    {
        self::$registry = $registry = Registry::getRegistryInstance();

        self::mapCoreInstances();

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
        $context->mapInstance("IFrontController", "FrontController", array("IModuleMapper"), true);


        self::$registry->addMappingContext($context);
    }

    private static function setConfig($baseDir)
    {
        $configPath = $baseDir . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR;

        // Init DB-Config
        $dbConfig = self::$registry->getInstance("IDbConfig");
        $dbConfigFile = $configPath . "config_db.ini";
        $dbConfig->setConfigFile($dbConfigFile);

        // Init Entity-Table-Mapper
        $entityTableMapper = self::$registry->getInstance("IEntityTableMapper");
        $entityTableConfigFile = $configPath . "db_entity_table_map.ini";
        $entityTableMapper->setEntityTableMap($entityTableConfigFile);

        // Init Module-Mapper
        $moduleMapper = self::$registry->getInstance("IModuleMapper");
        $moduleMapFile = $configPath . "module_map.ini";
        $moduleMapper->setModuleMap($moduleMapFile);
    }
}