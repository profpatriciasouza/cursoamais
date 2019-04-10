<?php

/**
 * Description of Panel
 *
 * @author lucas
 */
class HTML_Panel_Footer extends HTML {

    public $tagName = "panel/footer";
    public $titulo;
    public $load;
    public $footer;
    public $class = "panel-footer";

    public function __construct($id) {
        parent::__construct($id);
    }

}
