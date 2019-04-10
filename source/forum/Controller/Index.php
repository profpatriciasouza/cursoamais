<?php
class Controller_Index extends System_Controller {

    public function index() {
        $smodulo = new Security("modulo");
        if (!$smodulo->has("modulo")) {
            HTTP::redirect($this->url("alunos", "dashboard"));
        }
        
        HTTP::redirect($this->url("forum", "manage"));
            
    }

    public function init() {
        $this->setTitle("CursosAMais");
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
