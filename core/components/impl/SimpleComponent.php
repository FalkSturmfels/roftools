<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 30.12.2015
 * Time: 16:55
 */
class SimpleComponent implements IComponent
{
    public function getValue()
    {
        return "<p> Das ist ein Komponententest</p>";
    }

}