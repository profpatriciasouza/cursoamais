<?php

class Controller_Avaliacao extends System_Controller {

    public function index() {
        $ModelModulos = new Model_Modulos();
        $this->modulo = $ModelModulos->getById(Map::get('id'));
    }

    public function add() {

        if (HTTP::isPost()) {
            //ava_pk_id, ava_fk_module, ava_ds_name, ava_ds_description, ava_js_questions
            $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
            $ModelModulosAvaliacao->ava_fk_module = Map::get('id');
            $ModelModulosAvaliacao->ava_ds_name = HTTP::getPost('ava_ds_name');
            $ModelModulosAvaliacao->ava_ds_description = HTTP::getPost('ava_ds_description');
            $ModelModulosAvaliacao->ava_js_questions = json_encode(HTTP::getPost('ava_js_questions'));
            $id = $ModelModulosAvaliacao->salva();
            
            Error::add("AVA00001");
            
            HTTP::redirect($this->url("modules", "avaliacao", "edit", array("id" => Map::get('id'), "ava" => $id)));
        }

        $this->avaliacao = new Model_ModulosAvaliacao;

        $this->render("form");
    }

    public function edit() {

        if (HTTP::isPost()) {
            //ava_pk_id, ava_fk_module, ava_ds_name, ava_ds_description, ava_js_questions
            $questoes = HTTP::getPost('ava_js_questions');
            
            foreach($questoes as $k => $questao) {
                $questoes[$k] = json_decode($questao);
            }
            
            $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
            $ModelModulosAvaliacao->ava_pk_id = Map::get('ava');
            $ModelModulosAvaliacao->ava_fk_module = Map::get('id');
            $ModelModulosAvaliacao->ava_ds_name = HTTP::getPost('ava_ds_name');
            $ModelModulosAvaliacao->ava_ds_description = HTTP::getPost('ava_ds_description');
            $ModelModulosAvaliacao->ava_js_questions = json_encode($questoes);
            
            $ModelModulosAvaliacao->ava_js_questions = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
                return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
            }, $ModelModulosAvaliacao->ava_js_questions);
            
            $ModelModulosAvaliacao->ava_js_questions = addslashes($ModelModulosAvaliacao->ava_js_questions);
            $ModelModulosAvaliacao->salva();
            
            Error::add("AVA00002");
            
            HTTP::redirect($this->url("modules", "avaliacao", "edit", array("id" => Map::get('id'), "ava" => Map::get('ava'))));
        }

        $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
        $this->avaliacao = $ModelModulosAvaliacao->getByava_pk_id(Map::get('ava'));

        $this->render("form");
    }
    
    public function activate() {
        
        $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
        $ModelModulosAvaliacao->update(array("ava_in_status" => 1), "ava_pk_id = ".Map::get('ava'));
        
        
        echo "Alterado com sucesso!";
        $this->render(false);
    }
    
    public function delete() {
        
        $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
        $ModelModulosAvaliacao->update(array("ava_in_status" => 0), "ava_pk_id = ".Map::get('ava'));
        
        echo "Alterado com sucesso!";
        $this->render(false);
    }

    public function init() {
        Error::addMsg("AVA00001", "Avaliação cadastrada com sucesso!");
        Error::addMsg("AVA00002", "Avaliação alterada com sucesso!");
        Error::addMsg("AVA00003", "Avaliação excluído com sucesso!");
        $this->addAsset("/source/modules/Assets/js/avaliacao/form.js");
        
        
        DB_DDL::addField("modulos_avaliacao", "ava_in_status", "INT",1);
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
