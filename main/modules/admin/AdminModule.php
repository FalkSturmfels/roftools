<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 25.12.2015
 * Time: 11:18
 */
class AdminModule implements IModule
{

    private $contollerMap = array(
        "attributedef" => "AttributeDef",
        "talentdef" => "TalentDef"
    );

    private $actionMap = array(
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