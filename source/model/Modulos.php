<?php

class Model_Modulos extends DB_Model {

    public $nomeTabela = "modulos";
    public $chavePrimaria = "id";
    public $joins = array(
        "cursos" => "cursos.id = modulos.curso"
    );

    public function autorizado($CodigoAluno) {
        $ModelModulosAutorizados = new Model_ModulosAutorizados();
        $ModelModulosAutorizados->where("iddis = '" . $this->id . "'");
        $ModelModulosAutorizados->where("codigo_aluno = '" . $CodigoAluno . "'");
        //echo $ModelModulosAutorizados->getSelect();
        $ModelModulosAutorizados->select("id, iddis, codigo_aluno, Usuario_DataCadastro, nota, academico, mensagem, vencimento, valor, pagto, codigo_prof, cnr, pagou, idmodata, liberado");
        //var_dump($ModelModulosAutorizados->getRow()->data);
        return $ModelModulosAutorizados->getRow();
    }
    
    public function curso(){
        $ModelCurso = new Model_Cursos();
        return $ModelCurso->getById($this->curso);
    }
    
    public function professor() { 
        $professor = new Model_Usuarios;
        return $professor->getBycodigo_professor($this->codigo_professor);
    }
    
    public function hasArquivos() {
        $ModelUpload = new Model_Upload();
        return $ModelUpload->getAllBydisciplina($this->id) ? true : false;
    }
    
    public function arquivos() {
        $ModelUpload = new Model_Upload();
        $ModelUpload->orderby("ID DESC");
        return $ModelUpload->getAllBydisciplina($this->id);
    }
    
    public function hasAvaliacaoes() {
        $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
        return $ModelModulosAvaliacao->getByava_fk_module($this->id);
    }
    
    public function avaliacoes() {
        $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
        return $ModelModulosAvaliacao->getAllByava_fk_module($this->id);
    }

}
