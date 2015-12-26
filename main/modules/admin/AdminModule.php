<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 25.12.2015
 * Time: 11:18
 */
class AdminModule extends ModuleBase
{
    /**
     * AdminModule constructor.
     */
    public function __construct()
    {
        $this->contollerMap = array(
            "attributedef" => "AttributeDefController",
            "talentdef" => "TalentDefController"
        );

        $this->actionMap = array(
            "attributedef" => [
                "addattributedef" => "addAttributeDef",
                "removeattributedef" => "removeAttributeDef",
                "showattributedefs" => "showAttributeDefs",
            ],
            "talentdef" => array(
                "addtalent" => "addTalent",
                "removetalent" => "removeTalent",
                "showtalents" => "showTalents"
            )
        );
    }
}