<?php

class Controller_Topic extends System_Controller {

    public function index() {
        if (HTTP::isPost()) {

            $ModelComentarios = new Model_Comentarios;
            $ModelComentarios->Parent_id = Map::get('id');
            $ModelComentarios->Body = HTTP::getPost('Mensagem');
            $ModelComentarios->Author = Security::get('NOME');
            $ModelComentarios->TheDate = date("Y-m-d H:i:s");

            Error::addMsg('COM0001', "Comentário incluído com sucesso");
            Error::add('COM0001');

            $ModelComentarios->salva();
        }


        $ModelFeedback = new Model_Feedback();
        $ModelFeedback->join("modulos", explode(",", "id as modid, curso,disciplina,codigo_professor,professor_email,Professor,texto,materia1,materia2,materia3,materia4,materia5,materia6,materia7,materia8,materia9,materia10,video1,video2,video3,video4,video5,video6,video7,video8,video9,video10,aula1,aula2,aula3,oqueler,conteudo,valor,vencimento,link1,link2,link3,dlink1,dlink2,dlink3,linkvalor,exercicio1,exercicio2,exercicio3,exercicio4,exercicio5,avaliacaofinal"));


        $this->topico = $ModelFeedback->getById(Map::get('id'));
    }

    public function init() {
        if (!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
