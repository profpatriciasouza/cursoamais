<?php

class Model_Upload extends DB_Model {

    public $nomeTabela = "upload";
    public $chavePrimaria = "id";
    public $joins = array(
        "cursos" => "cursos.id = modulos.curso"
    );

    public function aluno() {
        $ModelUsuarios = new Model_Usuarios;
        return $ModelUsuarios->getBycodigo_aluno($this->codigo_aluno);
    }

}
