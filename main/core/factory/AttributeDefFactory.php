<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 18:27
 */
class AttributeDefFactory
{
    public function createEntities(array $results)
    {
        $entities = array();
        foreach ($results as $result) {
            $entity = $this->createDto($result);
            array_push($entities, $entity);
        }

        return $entities;
    }

    private function createDto(array $result)
    {
        $attributeDef = new AttributeDefDto();

        $attributeDef->setId($result["id"]);
        $attributeDef->setDescription($result["description"]);
        $attributeDef->setName($result["name"]);
        $attributeDef->setToken($result["token"]);

        return $attributeDef;
    }
}