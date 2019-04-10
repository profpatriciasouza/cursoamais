<?php

$area = "banners";
System_CONFIG::mapAppend(array(
    $area => array(
        'path' => "/source/" . $area,
        'nameSpace' => 'default',
        'alias' => array(
            'topic' => Map::alias($area, "topic", "index")
        )
    )
));

if(!DB_DDL::tableExists("banner")) {
    $sql = "CREATE TABLE `banner` (
                `pk_id_ban` INT(11) NOT NULL AUTO_INCREMENT,
                `ban_ds_name` VARCHAR(120) NOT NULL,
                `ban_ds_description` VARCHAR(120) NOT NULL,
                `ban_ds_path` VARCHAR(120) NOT NULL,
                `ban_ds_url` TINYTEXT NOT NULL,
                `ban_in_order` INT(11) NOT NULL,
                `ban_in_views` INT(11) NOT NULL,
                `ban_in_clicks` INT(11) NOT NULL,
                PRIMARY KEY (`pk_id_ban`)
        )
        ENGINE=InnoDB
        ";
    
    DB::query($sql);
}


DB_Model::addFolder(dirname(__FILE__) . "/Model/");


Error::addMsg('BAN00001', "Banner inserido com sucesso!");
Error::addMsg('BAN00002', "Banner alterado com sucesso!");
Error::addMsg('BAN00003', "Banner excluído com sucesso!");
Error::addMsg('BAN00004', "Ordem alterada com sucesso!");
