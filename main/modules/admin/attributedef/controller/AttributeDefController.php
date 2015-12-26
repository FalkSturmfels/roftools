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
        echo "show all attribute defs now!";
    }
}