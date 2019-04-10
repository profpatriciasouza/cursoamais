<?php

$area = "forum";
System_CONFIG::mapAppend(array(
    $area => array(
        'path' => "/source/" . $area,
        'nameSpace' => 'default',
        'alias' => array(
            'topic' => Map::alias($area, "topic", "index")
        )
    )
));


/*
DB_Model::addFolder(dirname(__FILE__) . "/Model/");
Modules::register("Login", "Users_Login", dirname(__FILE__) . "/Modules/Login.php");
 */