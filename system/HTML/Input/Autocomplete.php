<?php

class HTML_Input_Autocomplete extends HTML_Input {

    public $tagName = "autocomplete";
    public $urlBusca = "";

    public function __construct($id, $type, $name, $label, $placeholder = null, $isRequired = false) {
        parent::__construct($id, $type, $name, $label, $placeholder, $isRequired);

        Template::addFile(Plugins_JQuery::getJQueryUI());
        Template::addFile("/system/Assets/js/html/input/autocomplete.js");
    }

    public function build() {
        $HTMLInput = new HTML_Input("ID_" . $this->id, "hidden", "ID_" . $this->name, $this->label, $this->placeholder);
        $HTMLInput->value = $this->value;
        $HTMLInput->build();

        $HTMLInput = new HTML_Input($this->id, "text", $this->name, $this->label, $this->placeholder);
        $HTMLInput->attributes = $this->attributes;
        $HTMLInput->autobusca = $this->urlBusca;
        $HTMLInput->value = $this->valueDescription;
        $HTMLInput->build();
    }

    /** GERADOR DE OUTPUT PARA AUTOCOMPLETE * */
    public $Model;
    public $idItem;
    public $descricaoItem;
    public $whereBusca;

    public function configuraOrigemDados($Model, $id, $descricaoItem, $whereBusca) {
        $this->Model = $Model;
        $this->idItem = $id;
        $this->descricaoItem = $descricaoItem;
        $this->whereBusca = $whereBusca;
    }

    public function busca() {
        $model = $this->Model;
        $model->where($this->whereBusca, array($_GET['term']));
        $rows = $model->getRows();

        if (!$rows)
            return array();

        $id = $this->idItem;
        $descricaoItem = $this->descricaoItem;

        $ret = array();
        foreach ((array) $rows as $row) {
            $r['id'] = $row->$id;
            $r['label'] = $row->$descricaoItem;
            $ret[] = $r;
        }
        return $ret;
    }

    public function getPostValue($vet) {
        $vet = parent::getPostValue($vet);
        $vet["ID_" . $this->name] = HTTP::getPost("ID_" . $this->name);
                
        return $vet;
    }

}