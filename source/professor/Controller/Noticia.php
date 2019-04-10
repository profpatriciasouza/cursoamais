<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Noticia extends System_Controller {

    public function index() {
        $ModelNoticias = new Model_Noticias;
        $ModelNoticias->join("modulos", array("disciplina"));
        $this->noticias = $ModelNoticias->getRows();
    }

    public function add() {

        if (HTTP::isPost()) {
            $ModelNoticias = new Model_Noticias;
            foreach ($_POST as $k => $v) {
                $ModelNoticias->$k = $v;
            }
            $ModelNoticias->data = date("Y-m-d H:i:s");
            $ModelNoticias->salva();
            Error::add("MU0001");

            HTTP::redirect($this->urlByAcao('index'));
        }



        $ModelNoticias = new Model_Noticias;
        $this->noticia = $ModelNoticias;

        $this->render("form");
    }

    public function edit() {

        if (HTTP::isPost()) {
            $ModelNoticias = new Model_Noticias;
            $ModelNoticias = $ModelNoticias->getById(Map::get('id'));
            foreach ($_POST as $k => $v) {
                $ModelNoticias->$k = $v;
            }

            $ModelNoticias->salva();


            Error::add("MU0002");

            HTTP::redirect($this->urlByAcao('index'));
        }

        $ModelNoticias = new Model_Noticias;
        $this->noticia = $ModelNoticias->getById(Map::get('id'));


        $this->render("form");
    }

    public function delete() {
        $ModelNoticias = new Model_Noticias;
        $ModelNoticias = $ModelNoticias->getById(Map::get('id'));
        if ($ModelNoticias)
            $ModelNoticias->deleteById($ModelNoticias->getId());

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
