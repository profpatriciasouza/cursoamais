<?php

/**
 * Description of HTML_Input
 *
 * @author schirm
 */
class HTML_Button extends HTML_Input {
    
    public $tagName = "button";
    public $type = "button";
    
    public function __construct($id, $type, $name, $label) {
        parent::__construct($id, $type, $name, $label, null, false);
        
    }
}
