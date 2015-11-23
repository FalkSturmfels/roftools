<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 22:27
 */
class AttibuteDto extends GlobalDto
{
    private $value;

    private $fix_value;

    private $attributeDef;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getFixValue()
    {
        return $this->fix_value;
    }

    /**
     * @param mixed $fix_value
     */
    public function setFixValue($fix_value)
    {
        $this->fix_value = $fix_value;
    }

    /**
     * @return AttributeDefDto
     */
    public function getAttributeDef()
    {
        return $this->attributeDef;
    }

    /**
     * @param AttributeDefDto $attributeDef
     */
    public function setAttributeDef(AttributeDefDto $attributeDef)
    {
        $this->attributeDef = $attributeDef;
    }


}