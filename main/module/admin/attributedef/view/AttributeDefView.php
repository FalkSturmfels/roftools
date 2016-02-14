<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 26.12.2015
 * Time: 22:53
 */
class AttributeDefView implements IView
{
    private $templateRegistry;

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
     * @param ITemplateRegistry $templateRegistry
     */
    public function __construct(ITemplateRegistry $templateRegistry)
    {
        $this->templateRegistry = $templateRegistry;
    }

    private function initView()
    {
        $template = $this->templateRegistry->getTemplate("attributeDefTable");

        if ($template === null)
        {
            $templateDir = dirname(__FILE__);
            $this->templateRegistry->createTemplateEntry("attributeDefTable", $templateDir, "attributeDefTable.tpl.html");
        }
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


    }
}