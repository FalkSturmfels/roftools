<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 11.11.2015
 * Time: 22:24
 */
class GlobalDto
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEntityName(){
        $className = get_class($this);
        $result = substr($className, 0, strlen($className)-3);
        return $result;
    }
}