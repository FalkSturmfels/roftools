<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 28.12.2015
 * Time: 14:39
 */
interface ITemplateConverter
{

    public function setDefaultTemplateDir($directory);

    public function setDefaultMainTemplate($mainTemplateName);

    /**
     * Overrides the default main template
     * @param $mainTemplateName String Name of the new main template
     * @param $path String Optional path in which the new main template are,
     *              if nothing is set, the method search in the default
     *              template directory
     */
    public function setCurrentMainTemplate($mainTemplateName, $path = "");

    public function setReplacementMap(IReplacementMap $replacementMap);

    /**
     * Converts the template and returns a html string
     * @return String
     */
    public function convert();
}