<?php

class Cad_Fields extends Template {

    public $fieldName;
    public $typeField;
    public $params = array();
    public $updateField = true;
    public $showOnGrid = true;
    public $showOnFieldset = true;
    
    public $changeOnInsert = true;
    public $changeOnUpdate = true;

    /* DB parameters */
    public $primaryKey = false; 
    public $templateName = "standart";
    
    public $obrigatorio = false;

    public function __construct($typeField, $fieldName, $alias = "") {
        $this->typeField = $typeField;
        $this->fieldName = $fieldName;
    }

    public function getGridFieldName() {
        if ($this->typeField == "select") {
            return !empty($this->desc) ? $this->desc : $this->fieldName;
        }
        return $this->fieldName;
    }

    public function __set($n, $v) {
        $this->params[$n] = $v;
    }

    public function is_set($n) {
        return isset($this->params[$n]);
    }

    public function __get($n) {
        return $this->get($n);
    }

    public function get($n, $grid = false) {
        switch ($n) {
            case 'id':
                if (!isset($this->params['id'])) {
                    return $this->fieldName;
                }
                return $this->params[$n];
                break;

            case 'value':
                if (!isset($this->params['value'])) {
                    return "";
                }
                switch ($this->typeField) {
                    case 'date':
                        if (preg_match("/-/", $this->params[$n])) {
                            $d = date("d/m/Y", strtotime($this->params[$n]));
                            System_Log::logit("Converte " . $n ." de ".$this->params[$n]." para ".$d, print_r($this, 1));
                            return $d;
                        }
                       
                        break;
                    case 'textarea':
                        return nl2br($this->params[$n]);
                        break;
                    case 'rte':
                        return stripslashes($this->params[$n]);
                        break;
                    case 'select':
                        if (count($this->options) > 0 && $grid) {
                            foreach ($this->options as $option) {
                                if ($option['cod'] == $this->params[$n]) {
                                    return $option['desc'];
                                }
                            }
                        }
                        break;
                    case 'sn':
                        return $this->params[$n] == 0 ? "Não" : "Sim";
                        break;
                }


                return $this->params[$n];
                break;
            default:
                return isset($this->params[$n]) ? $this->params[$n] : false;
                break;
        }
    }

    public function getGridValue() {
        return $this->get("value", true);
    }

    public function setTemplate($templateName = "standart") {
        $this->templateName = $templateName;
    }

    public function build() {

        $fileName = $this->typeField;
        if ($this->templateName != "standart") {
            $fileName.="_" . $this->templateName;
        }
        $this->getFile("/cad/fields/" . $fileName . ".php", $this->params);
    }

    public function setValue($valor = "") {
        switch ($this->typeField) {
            case 'datetime':
                if ($valor != "") {
                    @list($data, $hora) = explode(" ", $valor);
                    list($ano, $mes, $dia) = explode("-", $data);
                    $this->value = $dia . "/" . $mes . "/" . $ano;
                    $this->valueHora = $hora;
                }
                break;
            case 'date':
                if ($valor != "" && preg_match("/-/", $valor)) {
                    $value = date("d/m/Y", strtotime($valor));
                    System_Log::logit("Converte " . $valor . " para d/m/y", $value);
                    $this->value = $value;
                } else {
                    $this->value = $valor;
                }
                break;
            case 'multifile':
            case 'file':
                $this->value = json_decode($valor);
                break;
            default:
                $this->value = $valor;
                break;
        }
    }

    public function getPostValue() {
        switch ($this->typeField) {
            case 'datetime':
                return Ado::getDataTimeFormat($_POST[$this->fieldName] . " " . $_POST[$this->fieldName . "Hora"]);
                break;
            case 'date':
                if (isset($_POST[$this->fieldName]))
                    return Plugins_Data::datetimeToDB($_POST[$this->fieldName]);
                break;
            case 'multifile':
            case 'file':
                return isset($_POST[$this->fieldName]) ? json_encode($_POST[$this->fieldName]) : "";
                break;
            case 'rte':
                return isset($_POST[$this->fieldName]) ? addslashes($_POST[$this->fieldName]) : "";
                break;
            default:
                return !isset($_POST[$this->fieldName]) ? $this->value : $_POST[$this->fieldName];
                break;
        }
    }

}
