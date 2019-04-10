<?php

class Controller_Manage extends System_Controller {

    public function index() {
        $ModelFeedback = new Model_Feedback();
        $ModelFeedback->join("modulos", explode(",", "id as modid, curso,disciplina,codigo_professor,professor_email,Professor,texto,materia1,materia2,materia3,materia4,materia5,materia6,materia7,materia8,materia9,materia10,video1,video2,video3,video4,video5,video6,video7,video8,video9,video10,aula1,aula2,aula3,oqueler,conteudo,valor,vencimento,link1,link2,link3,dlink1,dlink2,dlink3,linkvalor,exercicio1,exercicio2,exercicio3,exercicio4,exercicio5,avaliacaofinal"));
        if (Security::get('tipo') == 'awersaw')
            $ModelFeedback->where("modulos.codigo_professor = '" . Security::get('codigo_professor') . "'");

        if (Security::get('tipo') == 'ueisyes') {
            $smodulo = new Security("modulo");
            $this->modulo = $smodulo->modulo;
            $ModelFeedback->where("modulos.id = '" . $this->modulo->id . "'");
        }
        
        $this->topicos = $ModelFeedback->getRows();
    }

    public function add() {
        if (HTTP::isPost()) {
            $ModelFeedback = new Model_Feedback();
            $topico = $ModelFeedback;

            foreach ($_POST as $k => $v) {
                $topico->$k = addslashes(htmlentities($v));
            }

            $topico->TheDate = date("Y-m-d H:i:s");



            Error::add('COM0002');

            $id = $topico->salva();

            HTTP::redirect($this->urlByAcao("edit", $id));
        }


        $ModelFeedback = new Model_Feedback();
        $this->topico = $ModelFeedback;


        $this->render("form");
    }

    public function edit() {

        if (HTTP::isPost()) {
            $ModelFeedback = new Model_Feedback();
            $topico = $ModelFeedback->getById(Map::get('id'));

            foreach ($_POST as $k => $v) {
                $topico->$k = addslashes(htmlentities($v));
            }


            Error::addMsg('COM0001', "Tópico alterado com sucesso!");
            Error::add('COM0001');

            $topico->salva();
        }


        $ModelFeedback = new Model_Feedback();
        $this->topico = $ModelFeedback->getById(Map::get('id'));

        $this->render("form");
    }

    public function delete() {


        $ModelFeedback = new Model_Feedback();
        $topico = $ModelFeedback->getById(Map::get('id'));
        if ($topico) {
            $comentarios = $topico->comentarios();
            if ($comentarios)
                foreach ($comentarios as $comentario) {
                    $comentario->delete("id = " . $comentario->id);
                }

            $topico->delete("id = " . $topico->id);
        }

        HTTP::redirect($this->urlByAcao("index"));
    }

    public function init() {

        Error::addMsg('COM0002', "Tópico cadastrado com sucesso!");
        Error::addMsg('COM0003', "Tópico excluído com sucesso!");


        $ModelModulos = new Model_Modulos;
        $this->modulos = $ModelModulos->getRows();
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
