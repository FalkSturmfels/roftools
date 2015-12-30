<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 26.12.2015
 * Time: 23:04
 */
interface IView
{
    /**
     * @param array $contentData
     */
    public function setContentData(array $contentData);

    public function showView();
}