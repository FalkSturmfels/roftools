<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 07.12.2015
 * Time: 21:11
 */
class CallbackFunction implements ICallbackFunction
{
    private $caller;

    private $methodName;

    /**
     * CallbackFunction constructor.
     * @param Object $caller
     * @param String $methodName
     */
    public function __construct($caller, $methodName)
    {
        $this->caller = $caller;
        $this->methodName = $methodName;
    }

    public function getCallable()
    {
        return array($this->caller, $this->methodName);
    }
}