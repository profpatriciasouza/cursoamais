<?php

class Model_Avisos extends DB_Model {

    public $nomeTabela = "avisos";
    public $chavePrimaria = "id";
   
    public function quem() {
        $ModelUsuarios = new Model_Usuarios;
        return $ModelUsuarios->getById($this->dequem);
    }
}
