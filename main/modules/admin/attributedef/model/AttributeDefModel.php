<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 17:39
 */
class AttributeDefModel implements IDbCallbackHandler
{
    private $attributeDefs;

    /**
     * AttributeDefModel constructor.
     * @param GenericFindService $findService
     */
    public function __construct(GenericFindService $findService)
    {
        $findService->findEntities($this, (new AttributeDefDto())->getEntityName());
    }

    // ============================================
    //
    //   IDbCallbackHandler implementation
    //
    // ============================================

    public function setResult(array $result){
        $factory = new AttributeDefFactory();
        $this->attributeDefs = $factory->createEntities($result);
    }

    public function setReturnValue($returnValue)
    {
        // Nothing to do
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