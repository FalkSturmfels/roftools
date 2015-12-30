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

    private $contentData;

    // ============================================
    //
    //   Content data keys
    //
    // ============================================

    const DATA_ATTRIBUTE_DEF_HEADLINE = "attributeDefHeadline";

    const DATA_ATTRIBUTE_DEF_HEAD_ROW = "attributeDefHeadRow";

    const DATA_ATTRIBUTE_DEF_ROWS = "attributeDefRows";


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
    }

    private function initView()
    {
        $this->initIncludeReplacements();

        $this->initTableReplacement();

        $this->templateConverter->setReplacementMap($this->replacementMap);
    }

    private function initIncludeReplacements()
    {
        $directory = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $filePath = $directory . "attributeDefViewTemplate.html";
        $this->replacementMap->createIncludeReplacement("content", $filePath);
    }

    private function initTableReplacement()
    {
        $table = new TableComponent();

        $headline = $this->contentData[AttributeDefView::DATA_ATTRIBUTE_DEF_HEADLINE];
        $headRow = $this->contentData[AttributeDefView::DATA_ATTRIBUTE_DEF_HEAD_ROW];
        $contentRows = $this->contentData[AttributeDefView::DATA_ATTRIBUTE_DEF_ROWS];

        $table->setHeadline($headline);
        $table->setHeadRow($headRow);
        $table->setContentRows($contentRows);

        $this->replacementMap->createValueReplacement("table", $table);
    }

    // ============================================
    //
    //   IView implementation
    //
    // ============================================

    /**
     * @param array $contentData
     */
    public function setContentData(array $contentData)
    {
        $this->contentData = $contentData;
    }


    public function showView()
    {
        $this->initView();

        echo $this->templateConverter->convert();
    }
}