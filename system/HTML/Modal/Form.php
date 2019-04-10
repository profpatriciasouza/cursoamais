<?php

class HTML_Modal_Form extends HTML_Modal {
    /*
     * tagName para modal se aplica somente aos modais
     */

    public $tagName = "form";
    public $titulo;
    public $form;
    public $btnSalvar;

    public function __construct($titulo, $id = "") {parent::__construct($id);
        $this->titulo = $titulo;
        
        /*
         * Adiciona arquivos da classe e tratametnos padrões para o Modal_Form
         */
        $this->addAsset('/system/Assets/js/html/modal/form.js');
        
        $this->btnSalvar = new HTML_Button("btnModel", "button", "btnModel", "Salvar");
        $this->btnSalvar->class = "btn-primary";
    }

    public function build() {
        
        $this->form->id = "formModel";
        
        $HTMLDiv = new HTML_Div();
        $HTMLDiv->class="row";
        $HTMLDiv->add($this->form);
        
        $this->form = $HTMLDiv;
        
        parent::build();
    }

}
