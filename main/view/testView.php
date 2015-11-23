<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../templateResolver/TemplateResolver.php';

$templateHandler = new TemplateResolver();
$templateHandler->load("testTemplate.html");
$templateHandler->display();

