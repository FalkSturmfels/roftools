<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 04.12.2015
 * Time: 12:51
 */
interface IDbConnector
{
    public function executeGetCommand(IGetCommand $command);
}