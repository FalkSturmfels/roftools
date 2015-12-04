<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 04.12.2015
 * Time: 12:46
 */
class DbConnectorMock implements IDbConnector
{

    public function executeQueryCommand(IDbCallbackHandler $callbackHandler, $query)
    {
        $result = $this->createResult();

        $callbackHandler->setResult($result);
    }

    private function createResult(){
        $result = array(
            array("id" => "1",
                "name" => "Mut",
                "token" => "MU",
                "description" => "Das ist eine Beschreibung"),

            array("id" => "2",
                "name" => "Klugheit",
                "token" => "KL",
                "description" => "Das ist eine Beschreibung"),

            array("id" => "3",
                "name" => "Intuition",
                "token" => "IN",
                "description" => "Das ist eine Beschreibung"),

            array("id" => "4",
                "name" => "Charisma",
                "token" => "CH",
                "description" => "Das ist eine Beschreibung"),

        );

        return $result;
    }
}