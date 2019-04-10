<?php

class Model_Feedback extends DB_Model {

    public $nomeTabela = "feedback";
    public $chavePrimaria = "id";
    public $joins = array(
        "modulos" => "feedback.produto=modulos.id"
    );


    public function comentarios() {
        $ModelComentarios = new Model_Comentarios();
        $ModelComentarios->where("Parent_id = '".$this->id."'");
        $ModelComentarios->orderby("TheDate ASC");
        
       // echo $ModelComentarios->getSelect();
        $comentarios = $ModelComentarios->getRows();
        return $comentarios ? $comentarios : array();
    }
    
    public function modulo() {
        $ModelModulos = new Model_Modulos;
        return $ModelModulos->getById($this->produto);
    }
}
