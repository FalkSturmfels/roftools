<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 17:48
 */
interface IDataCommandExecutor
{
    public function execGetRequest(IGetCommand $command);
}