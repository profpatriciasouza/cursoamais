<?php
/**
 * Tag H, exemplo H1, H2, H3
 *
 * @author lucas
 */
class HTML_H extends HTML {
    public $tagName = "H";
    
    /*
     * Propriedade especificadas desta tag
     */
    public $level = 1;
    public $conteudo = "";
    
    public function __construct($conteudo, $level=1) {
        $this->level = $level;
        $this->conteudo = $conteudo;
        return $this;
    }
}
