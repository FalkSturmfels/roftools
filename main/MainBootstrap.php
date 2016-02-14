<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 25.12.2015
 * Time: 15:02
 */
class MainBootstrap
{
    /**
     * @param String $stdTemplateDir
     */
    public static function boot($stdTemplateDir)
    {
        self::mapInstances();

        self::initTemplateRegistry($stdTemplateDir);
    }

    private static function mapInstances()
    {
        $context = new MappingContext();

        $context = self::mapModules($context);
        $context = self::mapControllers($context);
        $context = self::mapModels($context);
        $context = self::mapViews($context);
        $context = self::mapServices($context);
        $context = self::mapFactories($context);


        $registry = Registry::getRegistryInstance();
        $registry->addMappingContext($context);
    }

    private static function mapModules(MappingContext $context)
    {
        $context->mapInstance("IAdminModule", "AdminModule", null, true);

        return $context;
    }

    private static function mapControllers(MappingContext $context)
    {
        $context->mapInstance("IAttributeDefController", "AttributeDefController",
            array("IAttributeDefModel", "IAttributeDefView"), true);

        return $context;
    }

    private static function mapModels(MappingContext $context)
    {
        $context->mapInstance("IAttributeDefModel", "AttributeDefModel",
            array("IAttributeDefService"), true);

        return $context;
    }

    private static function mapServices(MappingContext $context)
    {
        $context->mapInstance("IAttributeDefService", "AttributeDefService",
            array("IGenericFindService", "IAttributeDefFactory"), true);

        return $context;
    }

    private static function mapFactories(MappingContext $context)
    {
        $context->mapInstance("IAttributeDefFactory", "AttributeDefFactory", null, true);

        return $context;
    }

    private static function mapViews(MappingContext $context)
    {
        $stdViewParams = array("Registry", "ITemplateConverter", "ITemplateRegistry");

        /*$context->mapInstance("IAttributeDefView", "AttributeDefView",
            $stdViewParams, true);*/

        return $context;
    }

    private static function initTemplateRegistry($stdTemplateDir)
    {
        $registry = Registry::getRegistryInstance();

        $templateRegistry = $registry->getInstance("ITemplateRegistry");

        $templateRegistry->createTemplateEntry("main", $stdTemplateDir, "main.tpl.html");
        $templateRegistry->createTemplateEntry("mainNavigation", $stdTemplateDir, "mainNavigation.tpl.html");
    }
}