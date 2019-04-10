<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Mural extends System_Controller {

    public function index() {
        $ModelMural = new Model_Mural;
        $ModelMural->join("modulos", array("disciplina"));
        $this->murais = $ModelMural->getRows();
    }

    public function add() {

        if (HTTP::isPost()) {
            $ModelMural = new Model_Mural;
            foreach ($_POST as $k => $v) {
                $ModelMural->$k = $v;
            }

            $ModelMural->salva();
            Error::add("MU0001");

            HTTP::redirect($this->urlByAcao('index'));
        }



        $ModelMural = new Model_Mural;
        $this->mural = $ModelMural;

        $this->render("form");
    }

    public function edit() {

        if (HTTP::isPost()) {
            $ModelMural = new Model_Mural;
            $ModelMural = $ModelMural->getById(Map::get('id'));
            foreach ($_POST as $k => $v) {
                $ModelMural->$k = $v;
            }

            $ModelMural->salva();


            Error::add("MU0002");

            HTTP::redirect($this->urlByAcao('index'));
        }

        $ModelMural = new Model_Mural;
        $this->mural = $ModelMural->getById(Map::get('id'));


        $this->render("form");
    }

    public function delete() {
        $ModelMural = new Model_Mural;
        $ModelMural = $ModelMural->getById(Map::get('id'));
        if ($ModelMural)
            $ModelMural->deleteById($ModelMural->getId());

        Error::add("MU0003");
        HTTP::redirect($this->urlByAcao('index'));
    }

    public function init() {
        Error::addMsg("MU0001", "Mensagem adicionada com sucesso");
        Error::addMsg("MU0002", "Mensagem alterada com sucesso");
        Error::addMsg("MU0003", "Mensagem excluída com sucesso");
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
