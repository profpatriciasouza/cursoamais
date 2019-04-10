<?php

/**
 * Cria input do Tipo select
 *
 * @author schirm
 */
class HTML_Input_Radio extends HTML_Input {

    public $tagName = "radio";

    /*
     * Propriedades especificas do objeto
     */
    public $options = array();

    public function __construct($id, $name, $label, $isRequired = false) {
        parent::__construct($id, null, $name, $label, null, $isRequired);
    }

    public function hasOption() {
        return count($this->options) > 0;
    }

    public function addOption(HTML_Input_Radio_Option $option) {
        $option->name = $this->name;
        $this->options[] = $option;
    }

    public function carregaOpcoes($modal, $campoOpcao, $campoDescricao, $campoVazio = "") {
        $opcoes = $modal->getRows();

        //Preenche como primeira opção o campo em branco
        if (!empty($campoVazio)) {
            $this->addOption(new HTML_Input_Radio_Option("", $campoVazio));
        }

        //adiciona ao log caso não tenha opções
        if (!$opcoes) {
            System_Log::logit("Adiciona opções para " . $this->id, "Não foi encontrado nenhum registro.");
            return;
        }

        //Alimenta o SELECT
        foreach ($opcoes as $opcao) {
            if ($this->value == "" && !$this->hasOption() && $this->isRequired) {
                $this->value = $opcao->$campoOpcao;
            }

            $this->addOption(new HTML_Input_Radio_Option($opcao->$campoOpcao, $opcao->$campoDescricao, $opcao->$campoOpcao == $this->value));
        }
    }

}
