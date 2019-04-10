<?php

class Controller_Modulos extends System_Controller {
    
    public function index() {
        $smodulo = new Security("modulo");
    }

    public function seleciona() {

        $ModelModulos = new Model_Modulos();
        $modulo = $ModelModulos->getById(Map::get('id'));

        if ($modulo) {
            $smodulo = new Security("modulo");
            $smodulo->modulo = $smodulo;

            HTTP::redirect($this->url("alunos", "modulos"));
        }
    }
    
    public function init() {
        $this->setTitle("CursosAMais");
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
