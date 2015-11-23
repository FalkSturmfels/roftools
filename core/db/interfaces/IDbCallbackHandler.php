<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 23:03
 */
interface IDbCallbackHandler
{
    public function setResult(array $result);

    public function setReturnValue($returnValue);
}