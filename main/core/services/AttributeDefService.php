<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 07.12.2015
 * Time: 21:04
 */
class AttributeDefService
{

    private $genericService;
    private $factory;

    private $callerSuccessFunction;

    /**
     * AttributeDefService constructor.
     * @param GenericFindService $genericService
     * @param AttributeDefFactory $factory
     */
    public function __construct(GenericFindService $genericService, AttributeDefFactory $factory)
    {
        $this->genericService = $genericService;
        $this->factory= $factory;
    }

    public function getAllAttributeDefs(CallbackFunction $successFunction)
    {
        $this->callerSuccessFunction = $successFunction;


        $callBackFunction = new CallbackFunction($this, "getAttributeDefsSuccessFunction");

        $this->genericService->findEntities((new AttributeDefDto())->getEntityName(), $callBackFunction);
    }

    public function getAttributeDefsSuccessFunction(array $result)
    {
        $dtos = $this->factory->createEntities($result);

        $this->callerSuccessFunction->executeCallback(array($dtos));
    }
}