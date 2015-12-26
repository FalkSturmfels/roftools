<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 26.12.2015
 * Time: 22:53
 */
class AttributeDefView implements IView
{
    private $templateConverter;

    /**
     * AttributeDefView constructor.
     * @param $templateConverter
     */
    public function __construct($templateConverter)
    {
        $this->templateConverter = $templateConverter;
    }

    public function showView()
    {
        
    }
}