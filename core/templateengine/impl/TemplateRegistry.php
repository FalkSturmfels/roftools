<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 07.02.2016
 * Time: 19:10
 */
class TemplateRegistry implements ITemplateRegistry
{
    private $templateMap;

    /**
     * @param String $templateName
     * @return Template
     */
    public function getTemplate($templateName)
    {
        if (array_key_exists($templateName, $this->templateMap))
        {
            return $this->templateMap[$templateName];
        }
        return null;
    }

    /**
     * @param String $templateName
     * @param String $templateDir
     * @param String $templateFile
     */
    public function createTemplateEntry($templateName, $templateDir, $templateFile)
    {
        $templatePath = $templateDir.DIRECTORY_SEPARATOR.$templateName;
        $this->templateMap[$templateName] = new Template($templateName, $templatePath);
    }
}