<?php

class HTML_Modal_Alerta extends HTML_Modal {

    /*
     * tagName para modal se aplica somente aos modais
     */
    public $tagName = "alerta";
    
    public $titulo;
    public $msg;
    public $form;

    public function __construct($titulo, $id = "") {
        parent::__construct($id);
        $this->titulo = $titulo;
        
        /*
         * Adiciona arquivos da classe e tratametnos padrões para o Modal_Form
         */
        $this->addAsset('/system/Assets/js/html/modal/alerta.js');
        
        $HTMLButton = new HTML_Button("btnSair", "button", "Sair", "OK");
        $HTMLButton->class = "sair btn-info";
        $this->btnSair = $HTMLButton;
        
        
    }
    
    public function redirecionar($url = "reload") {
        $this->btnSair->redirecionar=$url;
    }
    
    public function build() {
        parent::build();
    }

}
