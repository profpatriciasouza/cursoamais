<?php

class Error_Form {

    static $erros;

    static function add($campo, $msg) {
        Error_Form::$erros[] = array($campo => $msg);
    }

    static function hasErros() {
        return count(Error_Form::$erros) > 0;
    }
    
    static function getJson() {
        return json_encode(Error_Form::$erros);
    }
    
    static function json() {
        echo Error_Form::getJson(); 
    }

}
