<?php
/**
 * Description of Alert
 *
 * @author lucas
 */
class HTML_Alert extends HTML {
    
    public $tagName="alert";
    
    public $class = "alert-success";
    public $msg;
    
    public function __construct($msg) {
       parent::__construct("alert");
       
       $this->msg = $msg;
    }
}