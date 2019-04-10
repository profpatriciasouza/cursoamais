<?php

class DB_Pagination extends Template {

    public $modal;
    
    public $paramPagina="pg";
    
    public $rows;
    public $total;
    public $numPaginas;
    public $paginaAtual;
    public $itensPorPagina = 10;
    
    public function __construct($DBModal, $paramPagina="pg") {
        $this->paramPagina=$paramPagina;
        $this->modal = $DBModal;
        
        $this->getPaginaAtual();
        
        $limit = $this->modal->getLimit();
        
        $this->itensPorPagina = 
                preg_match("/,/", $limit) ? 
                (int)end(explode(",", $limit)) : 
            (!is_numeric($limit) ? 10 : $limit);
        $this->setaTotal($this->modal->count());
        
        $inicio = ($this->paginaAtual-1)*$this->itensPorPagina;
        
        $this->modal->limit($inicio.",".$this->itensPorPagina);
        $this->rows = $this->modal->getRows();
    }
    
    public function setaTotal($total) {
        $this->total = $total;
        $this->processaPaginacao();
    }

    public function getPaginacao() {
        $this->processaPaginacao();
        $this->getFile("pagination.php");
    }

    public function processaPaginacao() {
        $this->getPaginaAtual();
        $this->numPaginas = ceil($this->total / $this->itensPorPagina);
    }
    
    public function getPaginaAtual() {
        $this->paginaAtual = 
                    isset($_GET[$this->paramPagina]) ? 
                    ($_GET[$this->paramPagina] > 0 ? $_GET[$this->paramPagina] : 1) 
                    : 1;
        
        return $this->paginaAtual;
    }
}
