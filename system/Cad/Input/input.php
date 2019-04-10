<?php

class Cad_Input extends Cad_Fields {
    /*
     * Config Combo
     */

    public $table;
    public $cod;
    public $desc;
    /*public $value;*/
    
    public $options = array();
    public $orderby;
    
    public $Mask;
    public $showOnGrid = true;
    
    public $onChange = "";
    
    public $showSelecioneUmaOpcao = true;
    
    /* Cad_Button */
    public $classBTN = ""; //icon-ok

    public function configSelect($table, $cod, $desc, $order="") {
        $this->table = $table;
        $this->cod = $cod;
        $this->desc = $desc;
        $this->orderby = $order;
    }

    public $haveAuxButton = false;

    public function haveAuxButton($f=false) {
        $this->haveAuxButton = $f;
    }

    public $fields = array();

    public function addField($f) {
        $this->fields[] = $f;
    }

    public function addOption($Codigo, $Valor, $checked=false) {
        $this->options[] = array("cod" => $Codigo, "desc" => $Valor, "checked" => $checked);
    }

    public function getTable($table="") {
        if (!empty($this->table)) {
            if (is_object($this->table)) {
                $ado = $this->table;
            } else {
                $ado = new Ado();
                $ado->from = $this->table;
            }
            return $ado->from;
        }

        if (!empty($table)) {
            return $table;
        }
        return "";
    }

    public function getOptions() {

        if (!empty($this->table)) {
            if (is_object($this->table)) {
                $ado = $this->table;
            } else {
                $ado = new Ado();
                $ado->from = $this->table;
            }
            $ado->select = $ado->from."." . $this->cod . " as cod, " . $ado->from .".".$this->desc . " as `desc`";
            $this->orderby = empty($this->orderby) ? $this->desc : $this->orderby;
            $ado->orderby = $this->orderby;

            $options = $ado->getAll();
            if (is_array($options) && $this->showSelecioneUmaOpcao)
                $this->addOption("", "Selecione uma opção");
            if ($options)
                foreach ($options as $option) {
                    $this->addOption($option->cod, $option->desc);
                }
        }

        return json_decode(json_encode($this->options));
    }

}
