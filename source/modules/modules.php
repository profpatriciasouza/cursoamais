<?php

$area = "modules";
System_CONFIG::mapAppend(array(
    $area => array(
        'path' => "/source/" . $area,
        'nameSpace' => 'default',
        'alias' => array(
            'edit' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'edit',
            )
            , 'add' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'add',
            )
            , 'delete' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'delete',
            )
            , 'uploads' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'uploads',
            )
        )
    )
));

if (!DB_DDL::tableExists("modulos_avaliacao")) {
    $sql = "CREATE TABLE `modulos_avaliacao` (
	`ava_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
	`ava_fk_module` INT(11) NULL DEFAULT NULL,
	`ava_ds_name` VARCHAR(150) NULL DEFAULT NULL,
	`ava_ds_description` TEXT NULL,
	`ava_js_questions` LONGTEXT NULL,
	PRIMARY KEY (`ava_pk_id`)
)
ENGINE=InnoDB";

    DB::query($sql);
}

DB_DDL::addField("modulos", "posicao", "INT(11)");


Error::addMsg("MOD0001", "Módulo cadastrado com sucesso!");
Error::addMsg("MOD0002", "Módulo alterado com sucesso!");
Error::addMsg("MOD0003", "Módulo excluído com sucesso!");
Error::addMsg("MOD0004", "Posição atualizada com sucesso!");
