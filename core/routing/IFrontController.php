<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 22.12.2015
 * Time: 12:38
 */
interface IFrontController
{
    public function dispatch($url);
}