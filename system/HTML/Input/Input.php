<?php

/**
 * Description of HTML_Input
 *
 * @author schirm
 */
class HTML_Input extends HTML {
    
    public $tagName = "input";
    
    /*
     * Specific properties
     */
    public $type;
    public $label;
    public $name;
    public $placeholder;
    public $isRequired;
    public $value;
    
    public function __construct($id, $type, $name, $label, $placeholder=null, $isRequired=false) {
        parent::__construct($id);
        
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->isRequired = (bool)$isRequired;
    }
    
    public function getPostValue($vet) {
        $vet[$this->name] = HTTP::getPost($this->name);
        return $vet;
    } 
}
