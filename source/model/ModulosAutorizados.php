<?php

class Model_ModulosAutorizados extends DB_Model {

    public $nomeTabela = "modulos_autorizados";
    public $chavePrimaria = "id";
    
 
    public $vetAvaliacoes = false;
    public function loadAvaliacoes() {
        if(!$this->vetAvaliacoes && $this->avaliacoes!="") {
            $this->vetAvaliacoes = json_decode($this->avaliacoes, true);
        }
        
        return $this->vetAvaliacoes;
    }
    public function nota($ava_pk_id) {
        $this->loadAvaliacoes();
        if(isset($this->vetAvaliacoes[$ava_pk_id])) {
            return $this->vetAvaliacoes[$ava_pk_id]['nota'];
        }
        return "-";
    }
    public function avaliacao($ava_pk_id) {
        $this->loadAvaliacoes();
        if(isset($this->vetAvaliacoes[$ava_pk_id])) {
            return $this->vetAvaliacoes[$ava_pk_id];
        }
        return false;
    }
    public function salvaAvaliacao($ava_pk_id, $avaliacao) {
        $this->loadAvaliacoes();
        //var_dump($this->vetAvaliacoes);
        $this->vetAvaliacoes[$ava_pk_id] = $avaliacao;
        //var_dump($this->vetAvaliacoes);
        
        //exit;
        $this->avaliacoes = json_encode($this->vetAvaliacoes);
        $this->avaliacoes = addslashes($this->avaliacoes);
        $id = $this->getId();
        $this->salva();
        
        $this->id = $id;
    }
    public function refazer($ava_pk_id) {
        $this->loadAvaliacoes();
        unset($this->vetAvaliacoes[$ava_pk_id]);
        
        $this->avaliacoes = json_encode($this->vetAvaliacoes);
        $this->avaliacoes = addslashes($this->avaliacoes);
        $id = $this->getId();
        $this->salva();
        
        $this->id = $id;
    }
    public function status($ava_pk_id) {
        $this->loadAvaliacoes();
        if(isset($this->vetAvaliacoes[$ava_pk_id])) {
            return $this->vetAvaliacoes[$ava_pk_id]['status'];
        }
        return "aguardando";
    }
    public function questoes($ava_pk_id) {
        $this->loadAvaliacoes();
        if(isset($this->vetAvaliacoes[$ava_pk_id])) {
            return json_decode($this->vetAvaliacoes[$ava_pk_id]['ava_js_questions']);
        }
    }
}