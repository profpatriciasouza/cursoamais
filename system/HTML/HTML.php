<?php

class HTML extends Template {

    public $id;
    public $name;
    public $tagName;
    public $childs = array();
    public $attributes = array();
    public $handles = array();

    /* MAGIC METHODS */

    public function __construct($id) {
        $this->id = $id;
    }

    public function build() {
        if(HTTP::isPost() && isset($_REQUEST[$this->name])){
            
            $this->value = $_REQUEST[$this->name];
        }
        
        
        $this->childs = Hook::exec('html_pre_build', $this->childs);
        $this->getFile("html/" . $this->tagName);
        Hook::exec('html_pos_build', $this);
    }

    public function add($child) {
        $this->childs[] = $child;
    }

    public function __set($name, $value = "") {
        //Faz o mapa de campos para tratamento de erro no frontend.
        if ($name == "mapa" && !empty($this->name)) {
            Error::addMapaCammpos($value, $this->name);
            return;
        }
        if ($name == "class")
            if (isset($this->attributes[$name]))
                $this->attributes[$name].=" " . $value;
            else
                $this->attributes[$name] = $value;
        else
            $this->attributes[$name] = $value;
    }

    public function __get($name) {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : "";
    }

    public function getChilds() {
        return $this->childs;
    }

    public function getAttributes($except = array()) {
        $attributes = $this->attributes;
        foreach ($except as $e) {
            unset($attributes[$e]);
        }
        $html = '';
        foreach ($attributes as $name => $value) {
            $html.= $name . "='" . $value . "' ";
        }
        return $html;
    }

}