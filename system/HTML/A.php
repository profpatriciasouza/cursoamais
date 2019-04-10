<?php
class HTML_A extends HTML {
    public $tagName ="a";
    
    public $ancora;
    public $link;
    public $icone;
    
    
    public function __construct($id, $ancora, $link, $icone="") {
        parent::__construct($id);
        $this->ancora = $ancora;
        $this->link = $link;
        $this->icone = $icone;
    }
}
