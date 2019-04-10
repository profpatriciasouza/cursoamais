<?php
//configura máscara do campo
$this->class.= " money";
Template::addFile("/assets/js/jquery.mask.money.min.js");
Template::addFile("/system/Assets/js/html/input/money.js");
$this->getFile("/html/input/text");