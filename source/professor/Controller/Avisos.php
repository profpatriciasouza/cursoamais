<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Avisos extends System_Controller {

    public function index() {
        $ModelAvisos = new Model_Avisos;
        $ModelAvisos->where("aviso = 'a'");
        $this->avisosEspecificos = $ModelAvisos->getRows();

        $ModelAvisos = new Model_Avisos;
        $ModelAvisos->where("aviso = 'm'");
        $this->avisosModulos = $ModelAvisos->getRows();
    }

    public function add() {

        if (HTTP::isPost()) {
            $ModelAvisos = new Model_Avisos;
            //q1 = "INSERT into avisos (dequem, aviso, codigo_professor, codigo_aluno, aviso_aluno, data) VALUES ('"&request("dequem")&"', '"&request("av")&"', '"&codigo_aluno&"', '"&codigo_aluno&"', '"&request("aviso_aluno")&"', now())"
            $ModelAvisos->dequem = Security::get('Ordem');
            $ModelAvisos->aviso = HTTP::getPost('aviso');
            $ModelAvisos->codigo_aluno = is_array(HTTP::getPost('codigo_aluno')) ? implode(",", HTTP::getPost('codigo_aluno')) : HTTP::getPost('codigo_aluno');
            $ModelAvisos->codigo_professor = $ModelAvisos->codigo_aluno;
            $ModelAvisos->aviso_aluno = HTTP::getPost('aviso_aluno');
            $ModelAvisos->data = date("Y-m-d H:i:s");

            $id = $ModelAvisos->salva();

            Error::add('AV0001');

            HTTP::redirect($this->urlByAcao('edit', $id));
        }

        $this->aviso = new Model_Avisos();
        $this->aviso->aviso = Map::get('aviso');
        $this->render("form");
    }

    public function edit() {
        if (HTTP::isPost()) {
            $ModelAvisos = new Model_Avisos;
            //q1 = "INSERT into avisos (dequem, aviso, codigo_professor, codigo_aluno, aviso_aluno, data) VALUES ('"&request("dequem")&"', '"&request("av")&"', '"&codigo_aluno&"', '"&codigo_aluno&"', '"&request("aviso_aluno")&"', now())"
            $ModelAvisos->id = Map::get('id');
            $ModelAvisos->dequem = Security::get('Ordem');
            $ModelAvisos->aviso = HTTP::getPost('aviso');
            $ModelAvisos->codigo_aluno = is_array(HTTP::getPost('codigo_aluno')) ? implode(",", HTTP::getPost('codigo_aluno')) : HTTP::getPost('codigo_aluno');
            $ModelAvisos->codigo_professor = $ModelAvisos->codigo_aluno;
            $ModelAvisos->aviso_aluno = HTTP::getPost('aviso_aluno');
            $ModelAvisos->data = date("Y-m-d H:i:s");

            Error::add('AV0002');

            $ModelAvisos->salva();
        }

        $ModelAvisos = new Model_Avisos;
        $this->aviso = $ModelAvisos->getById(Map::get('id'));

        $this->render("form");
    }

    public function delete() {
        $ModelAvisos = new Model_Avisos;
        $ModelAvisos->deleteById(Map::get('id'));

        Error::add("AV0003");
        HTTP::redirect($this->urlByAcao('index'));
    }

    public function addModule() {
        $this->render("form-module");
    }

    public function editModule() {
        $this->render("form");
    }

    public function init() {
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }
}
