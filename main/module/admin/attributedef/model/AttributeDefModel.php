<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 17:39
 */
class AttributeDefModel
{
    private $attributeDefs;

    private $attributeDefService;

    /**
     * AttributeDefModel constructor.
     * @param AttributeDefService $attributeDefService
     */
    public function __construct(AttributeDefService $attributeDefService)
    {
        $this->attributeDefService = $attributeDefService;

        $callback = new CallbackFunction($this, "setResult");

        $this->attributeDefService->getAllAttributeDefs($callback);
    }

    public function setResult(array $dtos)
    {
        $this->attributeDefs = $dtos;
    }

    // ============================================
    //
    //   Getter
    //
    // ============================================

    /**
     * @return array
     */
    public function getAttributeDefs()
    {
        return $this->attributeDefs;
    }

}