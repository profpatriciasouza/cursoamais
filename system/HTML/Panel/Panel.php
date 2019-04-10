<?php

/**
 * Description of Panel
 *
 * @author lucas
 */
class HTML_Panel extends HTML {

    public $tagName = "panel";
    public $titulo;
    public $load;
    public $footer;
    public $class = "panel-info";

    public function __construct($id, $titulo, $load = "") {
        parent::__construct($id);
        $this->titulo = $titulo;
        $this->load = $load;
    }

}
