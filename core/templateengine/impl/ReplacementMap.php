<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 28.12.2015
 * Time: 15:29
 */
class ReplacementMap implements IReplacementMap
{
    private $includeMap = array();

    public function createIncludeReplacement($variableName, $filePath)
    {
        $this->includeMap[$variableName] = $filePath;
    }

    public function getIncludeReplacement($variableName)
    {
        if (array_key_exists($variableName,$this->includeMap))
        {
            return $this->includeMap[$variableName];
        }
        else
        {
            throw new InvalidArgumentException("Include variable " . $variableName . " is not mapped");
        }
    }

}