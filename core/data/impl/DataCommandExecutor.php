<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 13.11.2015
 * Time: 17:14
 */
class DataCommandExecutor implements IDataCommandExecutor
{
    private $dbConnector;

    /**
     * DBCommandExecutor constructor.
     * @param $dbConnector
     */
    public function __construct(IDbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    // ============================================
    //
    //   IDataCommandExecutor implementation
    //
    // ============================================


    public function execGetRequest(IGetCommand $command)
    {
        $this->dbConnector->executeGetCommand($command);
    }
}