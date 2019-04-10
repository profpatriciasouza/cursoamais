<?php

/**
 * Description of HTML_Input_Select_Option
 *
 * @author lucas
 */
class HTML_Input_Select_Option extends HTML_Input {

    public $tagName = "option";
    /*
     * Propriedades especificas da tag
     */
    public $value = "";
    public $content = "";
    public $parentValue = "";

    public function __construct($value, $content, $selected = false) {
        $this->value = $value;
        $this->content = $content;
        if ($selected)
            $this->selected = "selected";
    }

    public function build($parentValue = "") {
        $this->parentValue = $parentValue;
        parent::build();
    }

}
