<?php
class API_Rules {

    public $erros;
    
    static function addErro($campo, $msg) {
        Error_Form::add($campo, $msg);
    }

    static function hasErros() {
        return Error_Form::hasErros();
    }

    public $rules = array();

    public function setRules($rules = array()) {
        $this->rules = $rules;
    }

    //Checa se existem regras 
    public function hasRule($campo) {
        return isset($this->rules[$campo]);
    }

    //Aplica regras
    public function apply($campo, $valor, $r = "", $msg = "") {
        $rule = !empty($r) ? $r : $this->rules[$campo];

        if (is_array($rule)) {
            foreach ($rule as $r => $msg) {
                if (is_callable($msg)) {
                    $valor = $this->apply($campo, $valor, $msg);
                } else
                    $valor = $this->apply($campo, $valor, $r, $msg);
            }
        }

        if (is_callable($rule)) {
            $valor = $rule($valor);
        }

        if (is_string($rule)) {
            $valor = $this->$rule($campo, $valor, $msg);
        }

        return $valor;
    }
    
    public function required($campo, $valor, $msg) {
        if(empty($valor)) {
            $this->addErro($campo, $msg);
        }
        
        return $valor;
    }
    
    public function email($campo, $valor, $msg) {
        if(!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->addErro($campo, $msg);
        }
        
        return $valor;
    }
}
