<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Index extends System_Controller {

    public function index() {
        
        $ModelModulos = new Model_Modulos();
        $ModelModulos->where("codigo_professor = '".Security::get('codigo_professor')."'");
        
        $this->modulos = $ModelModulos->getRows();
    }

    public function dashboard() {
        $smodulo = new Security("modulo");

        if ($smodulo->has("modulo")) {
            HTTP::redirect($this->url("alunos", "modulos"));
        } else {
            
        }
    }

    public function login() {
        if ($_POST) {
            $ModelUsuarios = new Model_Usuarios();
            $ModelUsuarios->select("*, usuarios_cursos.Usuario_QuantidadeAcessos as quantos, usuarios_cursos.ultacesso as ultimavez, usuarios_cursos.Usuario_DataCadastro as cudt, usuarios_cursos.usuario_senha as cus, usuarios_cursos.Usuario_Login as cul, usuarios_cursos.produto as cuprod, usuarios_cursos.Validade_Assinatura as cuval, usuarios_cursos.codigo_aluno as cucodalu, usuarios_cursos.id as cuid ");
            $ModelUsuarios->join("usuarios_cursos");
            $ModelUsuarios->where("usuarios_cursos.Usuario_Login = 'manuela'");
            $usuario = $ModelUsuarios->getRow();

            Security::registerUser($usuario);



            HTTP::redirect($this->url("publico"));
        }
    }

    public function logout() {
        $smodulo = new Security("modulo");
        $smodulo->deleteNameSpace();

        Security::revokeAccess();
        HTTP::redirect($this->url("login"));
    }

    public function duvidas() {
           if (HTTP::isPost()) {
         
            $ModelMensagens = new Model_Mensagens;
            foreach ($_POST as $k => $v) {
                $ModelMensagens->$k = htmlentities($v);
            }
            $ModelMensagens->remetente = Security::get('Usuario_Email');
            $ModelMensagens->data = date("Y-m-d H:i:s");
            $ModelMensagens->salva();
            
            Error::add("DU0002");
            HTTP::redirect($this->urlByAcao("duvidas"));
        }
        
        
        $ModelMensagens = new Model_Mensagens;
        $ModelMensagens->orderby("data DESC");
        $this->mensagens = $ModelMensagens->getRows();
        
        $ModelMensagens = new Model_Mensagens;
        $ModelMensagens->where("remetente = '".Security::get('Usuario_Email')."'");
        $this->enviadas = $ModelMensagens->getRows();
    }

    public function duvidasResponder() {
        if (HTTP::isPost()) {
            $ModelMensagens = new Model_Mensagens;
            foreach ($_POST as $k => $v) {
                $ModelMensagens->$k = htmlentities($v);
            }
            $ModelMensagens->remetente = Security::get('Usuario_Email');
            $ModelMensagens->data['data'] = date("Y-m-d H:i:s");
            $ModelMensagens->salva();
            
            Error::add("DU0001");
            HTTP::redirect($this->urlByAcao("duvidas"));
        }


        $ModelMensagens = new Model_Mensagens;
        $this->mensagen = $ModelMensagens->getById(Map::get('id'));
        //mensagens
    }

    public function init() {
        Error::addMsg("DU0001", "Mensagem respondida com sucesso");
        Error::addMsg("DU0002", "Mensagem enviada com sucesso");
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
