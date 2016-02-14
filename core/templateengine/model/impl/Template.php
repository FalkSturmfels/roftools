<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 07.02.2016
 * Time: 18:44
 */
class Template
{

    private $name;

    private $templateFile;

    private $templateValueMap;

    private $templateIncludeMap;


    /**
     * Template constructor.
     * @param String $name
     * @param String $templateFile
     */
    public function __construct($name, $templateFile)
    {
        $this->name = $name;
        $this->templateFile = $templateFile;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getTemplateFile()
    {
        return $this->templateFile;
    }
}