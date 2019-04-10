<?php

class Model_Mural extends DB_Model {

    public $nomeTabela = "mural";
    public $chavePrimaria = "id";
    
    public $joins = array(
        "modulos" => "mural.produto=modulos.id"
    );
    
    public function __get($nome) {
        return $this->exists($nome) ? Encoding::utf8($this->modelparams[$nome]) : "";
    }
}
