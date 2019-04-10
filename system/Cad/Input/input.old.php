<?php

class Cad_Input extends Cad_Fields {
    /*
     * Config Combo
     */

    public $table;
    public $cod;
    public $desc;

    public function configSelect($table, $cod, $desc) {
        $this->table = $table;
        $this->cod = $cod;
        $this->desc = $desc;
    }

    public function getOptions() {
        if (is_object($this->table)) {
            $ado = $this->table;
        } else {
            $ado = new Ado();
            $ado->from = $this->table;
        }

        $ado->select = $this->cod . " as cod, " . $this->desc . " as `desc`";
        $ado->orderby = $this->desc . " ASC";

        return $ado->getAll();
    }

}
