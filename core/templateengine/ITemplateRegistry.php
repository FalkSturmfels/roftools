<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 07.02.2016
 * Time: 19:21
 */

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 07.02.2016
 * Time: 19:10
 */
interface ITemplateRegistry
{
    /**
     * @param String $templateName
     * @return Template
     */
    public function getTemplate($templateName);

    /**
     * @param String $templateName
     * @param String $templateDir
     * @param String $templateFile
     */
    public function createTemplateEntry($templateName, $templateDir, $templateFile);
}