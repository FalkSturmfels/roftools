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

    private $replacementMap;

    /**
     * AttributeDefView constructor.
     * @param ITemplateConverter ITemplateConverter $templateConverter
     * @param IReplacementMap IReplacementMap $replacementMap
     */
    public function __construct(ITemplateConverter $templateConverter, IReplacementMap $replacementMap)
    {
        $this->templateConverter = $templateConverter;
        $this->replacementMap = $replacementMap;

        $this->initView();
    }

    private function initView()
    {
        $filePath = dirname(__FILE__).DIRECTORY_SEPARATOR."attributeDefViewTemplate.html";
        $this->replacementMap->createIncludeReplacement("content", $filePath);
    }

    public function showView()
    {
        echo $this->templateConverter->convert();
    }
}