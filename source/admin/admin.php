<?php

$area = "admin";
System_CONFIG::mapAppend(array(
    $area => array(
        'path' => "/source/" . $area,
        'nameSpace' => 'default',
        'alias' => array(
            
        )
    )
));

Error::addMsg("SS0001", "Usuário e senha alterados com sucesso!");
Error::addMsg("PRO0001", "Professor excluído com sucesso!");
Error::addMsg("PRO0002", "Professor alterado com sucesso!");
Error::addMsg("PRO0003", "Professor incluído com sucesso!");


Error::addMsg("STU0001", "Aluno incluído com sucesso!");
Error::addMsg("STU0002", "Aluno alterado com sucesso!");
Error::addMsg("STU0004", "Login informado já existe");
/*
DB_Model::addFolder(dirname(__FILE__) . "/Model/");
Modules::register("Login", "Users_Login", dirname(__FILE__) . "/Modules/Login.php");
 */