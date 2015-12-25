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

        $context->mapInstance("IAttributeDefFactory", "AttributeDefFactory", null, true);
        $context->mapInstance("IAttributeDefModel", "AttributeDefModel", array("IAttributeDefService"), true);
        $context->mapInstance("IAttributeDefService", "AttributeDefService",
            array("IGenericFindService", "IAttributeDefFactory"), true);

        $registry = Registry::getRegistryInstance();
        $registry->addMappingContext($context);
    }
}