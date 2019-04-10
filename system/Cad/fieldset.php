<?php

class Cad_Fieldset extends Template {

    public $fieldsetName;
    public $fieldsetDescription;
    public $fieldsetType = "standart";
    public $fields = array();
    public $filtro = array();
    public $row;
    public $tableName = "";

    public function __construct($fieldsetName, $fieldsetDescription = "") {
        $this->fieldsetName = $fieldsetName;
        $this->fieldsetDescription = empty($fieldsetDescription) ? $fieldsetName : $fieldsetDescription;

        $this->addFilter("pre_insert", array(&$this, 'valida_obrigatoriedade'));
        $this->addFilter("pre_update", array(&$this, 'valida_obrigatoriedade'));
    }

    public function addFiltro(Cad_input $field) {
        $this->filtro[$field->fieldName] = $field;
    }

    public function addField(Cad_input $field) {
        $fieldName = $field->fieldName;
        if (is_object($this->row) && isset($this->row->$fieldName)) {
            System_Log::logit("Carrega dados do campo: " . $fieldName, $this->row->$fieldName);
            $field->setValue($this->row->$fieldName);
        }

        $this->fields[$field->fieldName] = $field;
    }

    public function build() {
        $this->getFile("/cad/fieldset/" . $this->fieldsetType . ".php", $this);
    }

    public function getRow($where) {
        $ado = new Ado($this->tableName);
        $ado->select = "*";
        if(!empty($where))
        $ado->where = $where;
        $this->row = $ado->getRow();

        if (count($this->fields) > 0) {
            foreach ($this->fields as $k => $field) {
                $fn = $field->fieldName;

                if (isset($this->row->$fn)) {
                    if (!isset($_POST[$fn])) {
                        System_Log::logit("Carrega dados do campo: " . $fn, $this->row->$fn);

                        $this->fields[$k]->setValue($this->row->$fn);
                    } else {
                        $this->fields[$k]->setValue($_POST[$fn]);
                    }
                }

                if ($field->primaryKey) {
                    $pk = $this->fields[$k];
                }

                if ($field->typeField == "nm") {
                    $nms[$k] = $field;
                }
            }
            if (isset($nms) && is_array($nms))
                foreach ($nms as $k => $nm) {
                    $ado = new Ado();
                    $ado->from = $nm->fieldName;
                    $ado->select = $nm->cod . " as cod";
                    $ado->where($pk->fieldName . "= '" . $pk->value . "'");
                    $values = $ado->getAll();
                    if (is_array($values))
                        foreach ($values as $value) {
                            $vs[$value->cod] = true;
                        }
                    if (isset($vs))
                        $this->fields[$k]->value = $vs;
                }
        }
    }

    public function insert() {

        if (empty($this->tableName)) {
            return false;
        }
        $ado = new Ado($this->tableName);
        $fields = array();
        foreach ($this->fields as $k => $f) {
            
            if(!$f->changeOnInsert) continue;
            if ($f->primaryKey) {
                $pk = $f;
            }
            if ($f->typeField != "nm")
                $fields[$k] = $f->getPostValue();
            else
                $nm[] = $f;
        }

        if (!$this->runFilter("pre_insert", array($fields, $this->fields))) {
            return false;
        }
        
        $Codigo = $ado->insert($fields);
        $this->runFilter('pos_insert', array($Codigo, $fields));
        if (isset($nm) && count($nm) > 0) {
            $vet[$pk->fieldName] = $Codigo;

            foreach ($nm as $n) {
                if (isset($_POST[$n->fieldName]) && is_array($_POST[$n->fieldName])) {
                    foreach ($_POST[$n->fieldName] as $v) {
                        $ado = new Ado($n->fieldName);
                        $vet[$n->cod] = $v;
                        $ado->insert($vet);
                    }
                }
            }
        }
        return $Codigo;
    }

    public $filters = array();

    public function addFilter($tag, $filter) {
        $this->filters[$tag][] = $filter;
    }

    public function runFilter($tag, $params = array()) {
        if (isset($this->filters[$tag]))
            foreach ($this->filters[$tag] as $filter) {
                if (!call_user_func_array($filter, $params))
                    return false;
            }

        return true;
    }

    public function update($where) {
        if (empty($this->tableName)) {
            echo "Não foi definida uma tabela para o fieldset " . $this->fieldsetDescription;
            exit;
        }
        $fields = array();
        foreach ($this->fields as $k => $f) {
            if(!$f->changeOnUpdate) continue;
            if ($f->primaryKey) {
                $pkName = $k;
                if(isset($_GET['pk']))
                $pk = $_GET['pk'][$k];
            }
            
            
            if (!$f->updateField)
                continue;

            if ($f->typeField != "nm")
                $fields[$k] = $f->getPostValue();
            else
                $nm[] = $f;

        }

        if (isset($nm) && count($nm) > 0) {
            foreach ($nm as $n) {
                $vet[$pkName] = $pk;
                $ado = new Ado($n->fieldName);
                $ado->delete($where);
                if (isset($_POST[$n->fieldName]) && is_array($_POST[$n->fieldName])) {
                    foreach ($_POST[$n->fieldName] as $v) {
                        $ado = new Ado($n->fieldName);
                        $vet[$n->cod] = $v;
                        $ado->insert($vet);
                    }
                }
            }
        }

        if (!$this->runFilter('pre_update', array($fields, $this->fields))) {
            return false;
        }

        $ado = new Ado($this->tableName);
        return $ado->update($where, $fields);
    }

    public function delete($where) {
        if (empty($this->tableName)) {
            echo "N�o foi definida uma tabela para o fieldset " . $this->fieldsetDescription;
            exit;
        }
        $ado = new Ado($this->tableName);
        return $ado->delete($where);
    }

    public function valida_obrigatoriedade($fields, $cadffields) {

        foreach ($cadffields as $field) {
            if ($field->obrigatorio && $fields[$field->fieldName] == "") {
                System_Log::logit("Erro validação", "Campo " . $field->fieldName);
                $_GET['msg'] = $field->fieldName;
                return false;
            }
        }
        return true;
    }

}
