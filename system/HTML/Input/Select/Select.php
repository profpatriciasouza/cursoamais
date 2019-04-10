<?php

/**
 * Cria input do Tipo select
 *
 * @author schirm
 */
class HTML_Input_Select extends HTML_Input {

    public $tagName = "select";

    /*
     * Propriedades especificas do objeto
     */
    public $options = array();

    public function __construct($id, $name, $label, $isRequired = false) {
        parent::__construct($id, null, $name, $label, null, $isRequired);
    }

    public function addOption(HTML_Input_Select_Option $option) {
        $this->options[] = $option;
    }
    
    public function hasOption() {
        return count($this->options)>0; 
    }

    public function carregaOpcoes($modal, $campoOpcao, $campoDescricao, $campoVazio="") {
        $opcoes = $modal->getRows();
        
        //Preenche como primeira opção o campo em branco
        if(!empty($campoVazio)) {
            $this->addOption(new HTML_Input_Select_Option("", $campoVazio));
        }

        //adiciona ao log caso não tenha opções
        if (!$opcoes) {
            System_Log::logit("Adiciona opções para " . $this->id, "Não foi encontrado nenhum registro.");
            return;
        }
        
        //Alimenta o SELECT
        foreach ($opcoes as $opcao) {
            $this->addOption(new HTML_Input_Select_Option($opcao->$campoOpcao, Encoding::utf8($opcao->$campoDescricao), $opcao->$campoOpcao==$this->value));
        }
    }

}
