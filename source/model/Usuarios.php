<?php

class Model_Usuarios extends DB_Model {

    public $nomeTabela = "usuarios";
    public $chavePrimaria = "Ordem";
    
    public $joins = array(
        "usuarios_cursos" => "usuarios.codigo_aluno = usuarios_cursos.codigo_aluno"
    );
    
    public function curso() {
        $ModelUsuariosCursos = new Model_UsuariosCursos;
        $curso = $ModelUsuariosCursos->getBycodigo_aluno($this->codigo_aluno);
        return !$curso ? new Model_UsuariosCursos : $curso;
    }

}
