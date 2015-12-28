<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 26.12.2015
 * Time: 22:42
 */
class TemplateConverter implements ITemplateConverter
{

    private $defaultTemplateDir;

    private $defaultMainTemplate;

    private $currentMainTemplate;

    private $replacementMap;

    public function setDefaultTemplateDir($directory)
    {
        $this->defaultTemplateDir = $directory;
    }

    public function setDefaultMainTemplate($mainTemplateName)
    {
        $this->defaultMainTemplate = $this->defaultTemplateDir .
            DIRECTORY_SEPARATOR . $mainTemplateName;
    }

    public function setCurrentMainTemplate($mainTemplateName, $path = "")
    {
        if ($path !== "")
        {
            $this->currentMainTemplate = $path . DIRECTORY_SEPARATOR .
                $mainTemplateName;
        }
        else
        {
            $this->currentMainTemplate = $this->defaultTemplateDir .
                DIRECTORY_SEPARATOR . $mainTemplateName;
        }
    }

    public function setReplacementMap(IReplacementMap $replacementMap)
    {
        $this->replacementMap = $replacementMap;
    }

    public function convert()
    {
        $template = $this->getCurrentMainTemplate();

        echo $template;
    }

    private function getCurrentMainTemplate()
    {
        if (!empty($this->currentMainTemplate))
        {
            $templateFile = $this->currentMainTemplate;
        }
        else
        {
            $templateFile = $this->defaultMainTemplate;
        }

        $this->currentMainTemplate = "";

        $template = $this->getTemplate($templateFile);

        return $template;
    }

    private function getTemplate($templateFile)
    {
        if (file_exists($templateFile))
        {
            return file_get_contents($templateFile);

        }
        return "";
    }
}