<?php

/*
  Controller padrão, executa todas as funcionalidades necessárias para
  o controller funcionar.

  @lucas      20140203 Arquivo normalizado
 */

class System_Controller extends Template {

    public $params = array();
    public $msg = array();
    protected $render = "";

    public function __construct($params = array()) {

        parent::__construct();
        $this->params = $params;

        $this->render = Map::$acao;

        $this->boot();
        $this->init();

        $metodo = Map::$acao;
        if (preg_match("/\-/", $metodo)) {
            $metodo = explode("-", $metodo);
            foreach ($metodo as $k => $v) {
                if ($k != 0)
                    $metodo[$k] = ucfirst(strtolower($v));
            }
            $metodo = implode("", $metodo);
        }

        $this->$metodo();

        if ($this->render !== false)
            $this->getFile(strtolower(Map::$modulo) . "/" . $this->render . ".php");

        $this->finish();
    }

    public function __destruct() {
        Hook::exec("destruicao_controller", array());
    }

    /*
      Encapsula funcionalidade de renderização que permite que um método
      chame outra view
     */

    public function render($render = "") {
        $this->render = $render;
    }

    //Garante que VIEW seja chamada mesmo quando não tiver método relacionado
    public function __call($name, $arguments) {
        
    }

    /*
      Métodos set e get permitem mandar variáveis para a VIEW de forma segura,
      garantindo que sejam acessívels de todas as VIEWS incluidas no processo.
     */

    public function __set($n, $v) {
        $this->params[$n] = $v;
    }

    public function __get($n) {
        return isset($this->params[$n]) ? $this->params[$n] : false;
    }

    public function exists($n) {
        return isset($this->params[$n]);
    }

    /* HOOKS de sobreposição */

    //Deve ser sobreposto apenas em um Controller abstrato
    public function boot() {
        
    }

    //Deve ser sobreposto apenas no controller de instância
    public function init() {
        
    }

    public function finish() {
        
    }

}
