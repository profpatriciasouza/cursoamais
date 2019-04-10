<?php

class Model_ModulosAvaliacao extends DB_Model {

    public $nomeTabela = "modulos_avaliacao";
    public $chavePrimaria = "ava_pk_id";

    public function questions() {
        return json_decode($this->ava_js_questions);
    }
    public function hasAwnsers() {
        
    }
}
