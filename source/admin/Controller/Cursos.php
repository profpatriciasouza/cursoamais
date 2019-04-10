<?php

class Controller_Cursos extends System_Controller {

    public function index() {
        $ModelCurso = new Model_Cursos;
        $ModelCurso->orderby("if(situacao='A', 0, 1) ASC");
        $this->cursos = $ModelCurso->getRows();
        /*var_dump($this->cursos[0]);
        exit;*/
        //conteudo_site
    }

    public function getData() {
        $vet = $_POST;

        $arquivo = "";
        if(isset($vet['iimagem_curso'])) {
            $arquivo = $vet['iimagem_curso'];
        }
        unset($vet['iimagem_curso']);
        
        
        if ($_FILES['imagem_curso']['size'] > 0) {
            $dir = System_CONFIG::get('upload_dir');
            $arquivo = preg_replace("/[^0-9a-zA-Z\.]/", "", $_FILES['imagem_curso']['name']);

            $i = 1;
            while (file_exists($dir . $arquivo)) {
                $arquivo = $i . "_" . preg_replace("/[^0-9a-zA-Z\.]/", "", $_FILES['imagem_curso']['name']);
                $i++;
            }
            move_uploaded_file($_FILES['imagem_curso']['tmp_name'], $dir.$arquivo);
        }
        
        $vet['imagem_curso'] = $arquivo;

        return $vet;
    }

    public function add() {
        if (HTTP::isPost()) {
            $vet = $this->getData();

            $ModelCurso = new Model_Cursos;
            $id = $ModelCurso->insert($vet);
            
            Error::add("CUR00001");
            
            HTTP::redirect($this->url("admin", "cursos", "edit", array("id" => $id)));
        }


        $ModelCurso = new Model_Cursos;
        $this->curso = $ModelCurso;
        $this->render("form");
    }

    public function edit() {
        if (HTTP::isPost()) {
            $vet = $this->getData();

            $ModelCurso = new Model_Cursos;
            $id = $ModelCurso->update($vet, "id = '".Map::get('id')."'");
            
            Error::add('CUR00002');
            
            HTTP::redirect($this->url("admin", "cursos", "edit", array("id" => Map::get("id"))));
        }
        
        
        $ModelCurso = new Model_Cursos;

        $this->curso = $ModelCurso->getById(Map::get("id"));

        $this->render("form");
    }

    public function ativar() {
        $ModelCurso = new Model_Cursos;
        $ModelCurso->update(array("situacao" => "A"), "id = '" . Map::get('id') . "'");

        Error::add('CUR00005');

        HTTP::redirect($this->url("admin", "cursos"));
    }

    public function delete() {
        $ModelCurso = new Model_Cursos;
        $ModelCurso->update(array("situacao" => "N"), "id = '" . Map::get('id') . "'");

        Error::add('CUR00004');

        HTTP::redirect($this->url("admin", "cursos"));
    }

    public function forceDelete() {
        $ModelModulos = new Model_Modulos;
        $ModelModulos->delete("curso = '".Map::get('id')."'");
        
        $ModelCurso = new Model_Cursos;
        $ModelCurso->deleteById(Map::get('id'));

        Error::add('CUR00003');

        HTTP::redirect($this->url("admin", "cursos"));
    }

    public function init() {
        Error::addMsg('CUR00001', "Curso cadastrado com sucesso!");
        Error::addMsg('CUR00002', "Curso alterado com sucesso!");
        Error::addMsg('CUR00003', "Curso excluído com sucesso!");
        Error::addMsg('CUR00004', "Curso desativado com sucesso!");
        Error::addMsg('CUR00005', "Curso ativado com sucesso!");
        $this->setTitle("CursosAMais");
        
        
        DB_DDL::addField("cursos", "link", "VARCHAR(100)");
        DB_DDL::addField("cursos", "conteudo_site", "LONGTEXT");
        
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
