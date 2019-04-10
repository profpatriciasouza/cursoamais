<?php

/**
 * Description of HTML_Input_Select_Option
 *
 * @author lucas
 */
class HTML_Input_Radio_Option extends HTML_Input {

    public $tagName = "radio_option";
    /*
     * Propriedades especificas da tag
     */
    public $value = "";
    public $content = "";
    public $parentValue = "";

    public function __construct($value, $content, $checked = false) {
        $this->value = $value;
        $this->content = $content;
        if ($checked)
            $this->checked = "checked";
    }

    public function build($parentValue = "") {
        $this->parentValue = $parentValue;
        parent::build();
    }

}
