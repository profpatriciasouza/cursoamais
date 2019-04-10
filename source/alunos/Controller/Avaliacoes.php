<?php

class Controller_Avaliacoes extends System_Controller {

    public function index() {
        $smodulo = new Security("modulo");
        $this->modulo = $smodulo->modulo;

        $ModelModulosAutorizados = new Model_ModulosAutorizados;
        $this->autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $this->modulo->getId());
    }

    public function realizar() {
        $smodulo = new Security("modulo");
        $this->modulo = $smodulo->modulo;


        $ModelModulosAutorizados = new Model_ModulosAutorizados;
        $this->autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $this->modulo->getId());

        if ($this->autorizado->status(Map::get("id")) == "aguardando") {
            $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
            $this->avaliacao = $ModelModulosAvaliacao->getById(Map::get("id"));
            $avaliacoes = $this->autorizado->loadAvaliacoes();
            
            $avaliacao = $this->avaliacao;
            $avaliacao->status = "realizando";
            $avaliacao->nota = 0;
            $avaliacao = $avaliacao->modelparams;
            $avaliacao['ava_js_questions'] = stripslashes($avaliacao['ava_js_questions']);
            $avaliacoes[Map::get('id')] = $avaliacao;
            $this->autorizado->avaliacoes = addslashes(json_encode($avaliacoes));
            $this->autorizado->salva();

            $ModelModulosAutorizados = new Model_ModulosAutorizados;
            $this->autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $this->modulo->getId());
        }
        
        $this->avaliacao = $this->autorizado->avaliacao(Map::get('id'));
    }
    
    public function salvar() {
        $smodulo = new Security("modulo");
        $this->modulo = $smodulo->modulo;

        $ModelModulosAutorizados = new Model_ModulosAutorizados;
        $this->autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $this->modulo->getId());
        
        $avaliacao = $this->autorizado->avaliacao(Map::get('id'));
        
        $avaliacao['ava_js_questions'] = json_decode($avaliacao['ava_js_questions'], true);
        
        $nota = 0;
        foreach($avaliacao['ava_js_questions'] as $q => $question) {
            if(isset($_POST['Question'][$question['id']])) {
                
                $avaliacao['ava_js_questions'][$q]["choose"] = $_POST['Question'][$question['id']];
                
                if($avaliacao['ava_js_questions'][$q]["choose"]==$question['correct']) {
                    $nota+=isset($question['peso']) ? $question['peso'] : 1;
                }
            }
        }
        
        $avaliacao['ava_js_questions'] = json_encode($avaliacao['ava_js_questions']);

        $avaliacao['nota'] = $nota;
        $avaliacao['status'] = "concluido";
        
       
        $this->autorizado->salvaAvaliacao(Map::get('id'), $avaliacao);
         
        Error::add('AVA00010');
        HTTP::redirect($this->urlByAcao("index", Map::get('id')));
    }

    public function init() {
        DB_DDL::addField("modulos_autorizados", "avaliacoes", "LONGTEXT");
        
        
        Error::addMsg("AVA00010", "Avaliação salva com sucesso!");
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
