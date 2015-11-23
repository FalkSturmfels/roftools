<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 17:14
 */
class DbCommandExecutor implements IDbCommandExecutor
{
    private $dbConnector;

    /**
     * DBCommandExecutor constructor.
     * @param $dbConnector
     */
    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function execQueryCommand(IDbCommand $command){
        $query = $command->getQuery();
        $callbackHandler = $command->getCallbackHandler();

        $this->dbConnector->executeQueryCommand($callbackHandler, $query);
    }
}