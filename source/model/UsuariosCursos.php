<?php

class Model_UsuariosCursos extends DB_Model {

    public $nomeTabela = "usuarios_cursos";
    public $chavePrimaria = "Id";
   
    public function countUploads($mid) {
        $ModelUpload = new Model_Upload();
        
        $ModelUpload->where("disciplina = ?", array($mid));
        $ModelUpload->where("codigo_aluno = '?'", array($this->codigo_aluno));
        
        $this->uploads = $ModelUpload->getRows();
        
        if($this->uploads)
            return count($this->uploads);
        else return "n/a";
    }

}
