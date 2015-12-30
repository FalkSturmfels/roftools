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
    public function __construct(ITemplateConverter $templateConverter,
                                IReplacementMap $replacementMap)
    {
        $this->templateConverter = $templateConverter;
        $this->replacementMap = $replacementMap;

        $this->initView();
    }

    private function initView()
    {
        $directory = dirname(__FILE__).DIRECTORY_SEPARATOR;
        $filePath = $directory."attributeDefViewTemplate.html";
        $this->replacementMap->createIncludeReplacement("content", $filePath);

        $this->replacementMap->createValueReplacement("text", "Das ist ein Testtext");
        $this->replacementMap->createValueReplacement("int", 13);

        $this->replacementMap->createValueReplacement("simpleComponent", new SimpleComponent());

        $this->templateConverter->setReplacementMap($this->replacementMap);
    }

    public function showView()
    {
        $this->templateConverter->convert();
    }
}