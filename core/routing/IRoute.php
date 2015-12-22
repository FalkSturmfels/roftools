<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 21.12.2015
 * Time: 21:04
 */
interface IRoute
{
    public function getModule();

    public function getController();

    public function getAction();

    public function getParams();
}