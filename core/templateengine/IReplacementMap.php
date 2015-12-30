<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 28.12.2015
 * Time: 15:03
 */
interface IReplacementMap
{

    public function createIncludeReplacement($variableName, $filePath);

    public function getIncludeReplacement($variableName);

    public function hasIncludeEntry($variableName);
}