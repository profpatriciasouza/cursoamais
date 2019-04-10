<?php

/**
 * Description of HTML_Input
 *
 * @author schirm
 */
class HTML_Input extends HTML {
    
    public $tagName = "input";
    public $type;
    public $label;
    public $placeholder;
    public $isRequired;
    
    /* TODO
     * - Mudar para vetor de tipos de erros,
     * - Mudar required para Obrigatório
     */
    public $msgRequired = "Preenchimento obrigatório.";
    
    public function __construct($id, $type, $name, $label, $placeholder=null, $isRequired=false) {
        parent::__construct($id);
        
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->isRequired = (bool)$isRequired;
    }
    
    public function setValue($value, $description="") {
        $this->value = $value;
        if(!empty($description)) {
            $this->valueDescription = $description;
        }
    }
}
