<?php

class Model_Product extends DB_Model {

    public $nomeTabela = "product";
    public $chavePrimaria = "pid";

    public function category() {
        if ($this->category == "") {
            $ModelCategory = new Model_Category();
            $this->category = $ModelCategory->getById($this->cid);
        }
        return $this->category;
    }

    public function imagens() {
        $anuncio = array(
            "foto1" => ""
            , "foto2" => ""
            , "foto3" => ""
            , "foto4" => ""
            , "foto5" => ""
            , "foto6" => ""
        );

        return $this->imagens == "" ? json_decode(json_encode($anuncio)) : json_decode($this->imagens);
    }

    public function anuncio() {
        if (is_object($this->anuncio)) {
            return $this->anuncio;
        } else {
            $anuncio = json_decode(json_encode(array(
                "id" => ""
                , "titulo" => ""
                , "status" => ""
                , "valor" => ""
                , "descricao" => ""
            )));

            $this->anuncio = $this->anuncio == "" ? $anuncio : json_decode($this->anuncio);
            if (is_null($this->anuncio))
                $this->anuncio = $anuncio;

            return $this->anuncio();
        }
    }

    public function freteNormal() {
        $anuncio = array(
            "id" => ""
            , "titulo" => ""
            , "status" => ""
            , "valor" => ""
            , "descricao" => ""
        );

        return $this->freteNormal == "" ? json_decode(json_encode($anuncio)) : json_decode($this->freteNormal);
    }

    public function freteGratis() {
        if (is_object($this->freteGratis)) {
            return $this->freteGratis;
        } else {
            $anuncio = json_decode(json_encode(array(
                "id" => ""
                , "titulo" => ""
                , "status" => ""
                , "valor" => ""
                , "descricao" => ""
            )));

            $this->freteGratis = $this->freteGratis == "" ? $anuncio : json_decode($this->freteGratis);
            if (is_null($this->freteGratis))
                $this->freteGratis = $anuncio;

            return $this->freteGratis();
        }
    }

    public function freteNormalPremium() {
        if (is_object($this->freteNormalPremium)) {

            return $this->freteNormalPremium;
        } else {
            $anuncio = json_decode(json_encode(array(
                "id" => ""
                , "titulo" => ""
                , "status" => ""
                , "valor" => ""
                , "descricao" => ""
            )));

            $this->freteNormalPremium = $this->freteNormalPremium == "" ? $anuncio : json_decode($this->freteNormalPremium);
            if (is_null($this->freteNormalPremium) && $this->freteNormalPremium == "")
                $this->freteNormalPremium = $anuncio;
            
            return $this->freteNormalPremium();
        }
    }

    /* public function freteNormalPremium() {
      $anuncio = array(
      "id" => ""
      , "titulo" => ""
      , "status" => ""
      , "valor" => ""
      , "descricao" => ""
      );

      return $this->freteNormalPremium == "" ? json_decode(json_encode($anuncio)) : json_decode($this->freteNormalPremium);
      } */

    public function freteGratisPremium() {
        $anuncio = array(
            "id" => ""
            , "titulo" => ""
            , "status" => ""
            , "valor" => ""
            , "descricao" => ""
        );

        return $this->freteGratisPremium == "" ? json_decode(json_encode($anuncio)) : json_decode($this->freteGratisPremium);
    }

}
