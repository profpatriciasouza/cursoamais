<?php

class Model_Noticias extends DB_Model {

    public $nomeTabela = "noticias";
    public $chavePrimaria = "id";
    
    public $joins = array(
        "modulos" => "noticias.produto=modulos.id"
    );
    
    public function __get($nome) {
        return $this->exists($nome) ? Encoding::utf8($this->modelparams[$nome]) : "";
    }
}
