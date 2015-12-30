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

    private $defaultReplacementMap;

    /**
     * TemplateConverter constructor.
     * @param $defaultReplacementMap IReplacementMap
     */
    public function __construct(IReplacementMap $defaultReplacementMap)
    {
        $this->defaultReplacementMap = $defaultReplacementMap;
    }

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

        $template = $this->replaceValues($template);

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
        else
        {
            throw new Exception("File: " . $templateFile . " doesn't exists");
        }
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

                $template = $this->replaceInclude($template, $includeExp, $variable);
            }

            return $this->replaceIncludes($template);
        }
        else
        {
            return $template;
        }
    }

    private function replaceInclude($template, $includeExp, $variableName)
    {
        $includeFilePath = $this->getIncludeReplacement($variableName);

        $include = $this->getFileContent($includeFilePath);

        $template = preg_replace("/" . $includeExp . "/", $include, $template);

        return $template;
    }

    private function getIncludeReplacement($variableName)
    {
        if ($this->replacementMap->hasIncludeEntry($variableName))
        {
            return $this->replacementMap->getIncludeReplacement($variableName);
        }
        else if ($this->defaultReplacementMap->hasIncludeEntry($variableName))
        {
            return $this->defaultReplacementMap->getIncludeReplacement($variableName);
        }
        else
        {
            throw new InvalidArgumentException("Variable name " . $variableName .
                " is not mapped in any include replacement map.");
        }
    }

    // ============================================
    //
    //   Replace values / components
    //
    // ============================================

    private function replaceValues($template)
    {
        $includes = array();
        preg_match_all("/{value:(.)*}/", $template, $includes);

        if (!empty($includes) && !empty($includes[0]))
        {
            foreach ($includes[0] as $includeExp)
            {
                $include = trim($includeExp, "{}");

                $includeSplit = preg_split("/:/", $include);

                $variable = $includeSplit[1];

                $template = $this->replaceValue($template, $includeExp, $variable);
            }

        }
        return $template;
    }


    private function replaceValue($template, $includeExp, $variableName)
    {
        $value = $this->getValueReplacement($variableName);


        $template = preg_replace("/" . $includeExp . "/", $value, $template);

        return $template;
    }

    private function getValueReplacement($variableName)
    {
        if ($this->replacementMap->hasValueEntry($variableName))
        {
            $value = $this->replacementMap->getValueReplacement($variableName);
        }
        else if ($this->defaultReplacementMap->hasValueEntry($variableName))
        {
            $value = $this->defaultReplacementMap->getValueReplacement($variableName);
        }
        else
        {
            throw new InvalidArgumentException("Variable name " . $variableName .
                " is not mapped in any include replacement map.");
        }

        if ($value instanceof IComponent)
        {
            $value = $value->getValue();
        }

        return $value . "";
    }
}