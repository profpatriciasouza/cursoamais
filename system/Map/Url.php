<?php

class Map_Url {

    public $area;
    public $modulo;
    public $acao;
    public $parametros;

    public function __construct($area = "", $modulo = "", $acao = "", $parametros = "") {
        if (is_array($area)) {
            $this->area = $area['area'];
            $this->modulo = isset($area['modulo']) ? $area['modulo'] : "index";
            $this->acao = isset($area['acao']) ? $area['acao'] : "index";
            $this->parametros = isset($area['parametros']) ? $area['parametros'] : "index";
        } else {
            $this->area = $area;
            $this->modulo = $modulo;
            $this->acao = $acao;
            $this->parametros = $parametros;
        }
    }

    public function parametros($params) {
        if (!is_array($params))
            return;


        $parametros = array();
        unset($params['area']);
        unset($params['modulo']);
        unset($params['acao']);

        foreach ((array) $params as $k => $p) {
            $parametros[] = "$k/$p";
        }
        return "/" . implode("/", $parametros);
    }

    public function is() {
        return Map::$area == $this->area && (empty($this->modulo) || Map::$modulo == $this->modulo) && (empty($this->acao) || Map::$acao == $this->acao);
    }

    public function __toString() {
        return Map::getRoot(true) .
                $this->area . "/" .
                ($this->modulo == "" ? "" : $this->modulo) .
                (empty($this->acao) ? "" : (is_array($this->acao) ? $this->parametros($this->acao) : "/" . $this->acao)) .
                (is_array($this->parametros) ? $this->parametros($this->parametros) : "");
    }

}
