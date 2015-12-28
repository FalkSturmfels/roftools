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

    // ============================================
    //
    //   ITemplateConverter implementation
    //
    // ============================================

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

        $template = $this->replaceIncludes($template);

        echo $template;
    }

    // ============================================
    //
    //   Get current template
    //
    // ============================================

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

        $template = $this->getFileContent($templateFile);

        return $template;
    }

    private function getFileContent($templateFile)
    {
        if (file_exists($templateFile))
        {
            return file_get_contents($templateFile);
        }
        return "";
    }

    // ============================================
    //
    //   Replace includes
    //
    // ============================================

    private function replaceIncludes($template)
    {
        $includes = array();
        preg_match_all("/{include:(.)*}/", $template, $includes);

        if (!empty($includes) && !empty($includes[0]))
        {
            foreach ($includes[0] as $includeExp)
            {
                $include = trim($includeExp, "{}");

                $includeSplit = preg_split("/:/", $include);

                $variable = $includeSplit[1];

                $template = $this->replaceInclude($template,$includeExp, $variable);
            }

            return $template;
        }
        else
        {
            return $template;
        }
    }

    private function replaceInclude($template, $includeExp, $variableName)
    {
        $includeFilePath = $this->replacementMap
            ->getIncludeReplacement($variableName);

        $include = $this->getFileContent($includeFilePath);

        $template = preg_replace("/" . $includeExp . "/", $include, $template);

        return $this->replaceIncludes($template);
    }
}