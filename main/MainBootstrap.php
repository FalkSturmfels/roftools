<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 25.12.2015
 * Time: 15:02
 */
class MainBootstrap
{
    public static function boot()
    {
        self::mapInstances();
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

        self::initTemplateConverter();
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
        $stdViewParams = array("ITemplateConverter", "IReplacementMap");

        $context->mapInstance("IAttributeDefView", "AttributeDefView",
            $stdViewParams, true);

        return $context;
    }

    private static function initTemplateConverter()
    {
        $registry = Registry::getRegistryInstance();
        $converter = $registry->getInstance("ITemplateConverter");

        $directory = dirname(__FILE__).DIRECTORY_SEPARATOR."template";
        $converter->setDefaultTemplateDir($directory);
        $converter->setDefaultMainTemplate("mainTemplate.html");
    }
}