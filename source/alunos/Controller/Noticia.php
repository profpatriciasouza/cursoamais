<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Noticia extends System_Controller {

    public function index() {
        $smodulo = new Security("modulo");
        
        
        $ModelNoticias = new Model_Noticias;
        $ModelNoticias->join("modulos", array("disciplina"));
        $ModelNoticias->where("produto = '".$smodulo->modulo->id."'");
        
        $this->noticias = $ModelNoticias->getRows();
    }
    
    public function init() {
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
