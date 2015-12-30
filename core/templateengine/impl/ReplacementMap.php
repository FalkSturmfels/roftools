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

    private $valueMap = array();

    public function createIncludeReplacement($variableName, $filePath)
    {
        $this->includeMap[$variableName] = $filePath;
    }

    public function getIncludeReplacement($variableName)
    {
        if (array_key_exists($variableName, $this->includeMap))
        {
            return $this->includeMap[$variableName];
        }
        else
        {
            throw new InvalidArgumentException("Include variable " . $variableName . " is not mapped");
        }
    }

    public function hasIncludeEntry($variableName)
    {
        return array_key_exists($variableName, $this->includeMap);
    }


    public function createValueReplacement($variableName, $value)
    {
        $this->valueMap[$variableName] = $value;
    }

    public function getValueReplacement($variableName)
    {
        if (array_key_exists($variableName, $this->valueMap))
        {
            return $this->valueMap[$variableName];
        }
        else
        {
            throw new InvalidArgumentException("Include variable " . $variableName . " is not mapped");
        }
    }

    public function hasValueEntry($variableName)
    {
        return array_key_exists($variableName, $this->valueMap);
    }
}