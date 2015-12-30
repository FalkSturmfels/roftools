<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 25.12.2015
 * Time: 14:33
 */
class AttributeDefController
{
    private $model;

    private $view;

    /**
     * AttributeDefController constructor.
     * @param AttributeDefModel $attributeDefModel
     * @param IView $view
     */
    public function __construct(AttributeDefModel $attributeDefModel, IView $view)
    {
        $this->model = $attributeDefModel;
        $this->view = $view;
    }


    public function addAttributeDef()
    {

    }

    public function removeAttributeDef()
    {

    }

    public function showAttributeDefs()
    {
        $this->setContentData();

        $this->view->showView();
    }

    // ============================================
    //
    //   Show attribute definitions helper methods
    //
    // ============================================

    private function setContentData()
    {
        $headline = $this->createHeadline();
        $headRow = $this->createHeadRow();
        $contentRows = $this->createContentRows();

        $contentData = array();
        $contentData[AttributeDefView::DATA_ATTRIBUTE_DEF_HEADLINE] = $headline;
        $contentData[AttributeDefView::DATA_ATTRIBUTE_DEF_HEAD_ROW] = $headRow;
        $contentData[AttributeDefView::DATA_ATTRIBUTE_DEF_ROWS] = $contentRows;

        $this->view->setContentData($contentData);
    }

    private function createHeadline()
    {
        return "Eigenschaften";
    }

    private function createHeadRow()
    {
        return array("Name", "Abkürzung", "Beschreibung");
    }

    private function createContentRows()
    {
        $rows = array();

        $attributeDefs = $this->model->getAttributeDefs();

        foreach ($attributeDefs as $attributeDefDto)
        {
            $row = [$attributeDefDto->getName(),
                    $attributeDefDto->getToken(),
                    $attributeDefDto->getDescription()];

            array_push($rows, $row);
        }

        return $rows;
    }
}