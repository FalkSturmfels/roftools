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
            "AttributeDef" => array(
                "addattributedef" => "addAttributeDef",
                "removeattributedef" => "removeAttributeDef",
                "showattributedefs" => "showAttributeDefs"
            ),
            "TalentDef" => array(
                "addtalent" => "addTalent",
                "removetalent" => "removeTalent",
                "showtalents" => "showTalents"
            )
        );
    }
}