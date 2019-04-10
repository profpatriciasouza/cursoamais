<?php

$area = "professor";
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

Error::addMsg('AV0001', "Aviso incluido com sucesso!");
Error::addMsg('AV0002', "Aviso alterado com sucesso!");
Error::addMsg('AV0003', "Aviso excluído com sucesso!");