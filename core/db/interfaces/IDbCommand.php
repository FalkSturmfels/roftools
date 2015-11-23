<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 22:59
 */
interface IDbCommand
{
    /**
     * Returns the sql query
     * @return void
     */
    public function getQuery();

    /**
     * Sets the callback handler
     * @param IDbCallbackHandler $handler
     * @return void
     */
    public function setCallbackHandler(IDbCallbackHandler $handler);

    public function getCallbackHandler();
}