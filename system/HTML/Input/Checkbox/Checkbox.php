<?php

/**
 * Cria input do Tipo select
 *
 * @author schirm
 */
class HTML_Input_Checkbox extends HTML_Input {

    public $tagName = "checkbox";

    /*
     * Propriedades especificas do objeto
     */
    public $options = array();

    public function __construct($id, $name, $label, $isRequired = false) {
        parent::__construct($id, null, $name, $label, null, $isRequired);
    }

    public function addOption(HTML_Input_Checkbox_Option $option) {
        $option->name = $this->name;
        $this->options[] = $option;
    }

    public function carregaOpcoes($modal, $campoOpcao, $campoDescricao, $campoVazio="") {
        $opcoes = $modal->getRows();
        
        //Preenche como primeira opção o campo em branco
        if(!empty($campoVazio)) {
            $this->addOption(new HTML_Input_Checkbox_Option("", $campoVazio));
        }

        //adiciona ao log caso não tenha opções
        if (!$opcoes) {
            System_Log::logit("Adiciona opções para " . $this->id, "Não foi encontrado nenhum registro.");
            return;
        }
        
        //Alimenta o SELECT
        foreach ($opcoes as $opcao) {
            $this->addOption(new HTML_Input_Checkbox_Option($opcao->$campoOpcao, $opcao->$campoDescricao, $opcao->$campoOpcao==$this->value));
        }
    }

}
