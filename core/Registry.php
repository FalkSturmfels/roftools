<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 01.12.2015
 * Time: 12:41
 */
class Registry
{

    private $coreDef = array(
        "IDbConnector" => "DbConnector",
        "IDbCommandExecutor" => "DbCommandExecutor",
        "GetCommand" => "GetCommand"
    );

    private $coreParams = array(
        "IDbCommandExecutor" => array("IDbConnector", "GetCommand")
    );
}