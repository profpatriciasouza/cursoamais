<?php

$area = "alunos";
System_CONFIG::mapAppend(array(
    $area => array(
        'path' => "/source/".$area,
        'nameSpace' => 'default',
        'alias' => array(
            'login' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'login',
            )
            , 'exit' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'logout',
            )
            , 'dashboard' => array(
                'area' => $area,
                'modulo' => 'index',
                'acao' => 'dashboard',
            )
        )
    )
));

DB_DDL::addField("usuarios", "foto", 'VARCHAR(100)');

Error::addMsg("DU0001", "Mensagem enviada com sucesso!");
Error::addMsg("FOT0001", "Foto atualizada com sucesso!");