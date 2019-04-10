<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Index extends System_Controller {

    public function index() {
        HTTP::redirect($this->urlByAcao("dashboard"));
    }
    
    public function dashboard() {

        
        $ModelUsuariosCurso = new Model_UsuariosCursos;
        $this->usuarioCurso = $ModelUsuariosCurso->getAllBycodigo_aluno(Security::get("codigo_aluno"));

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

    public function init() {
        $this->setTitle("CursosAMais");
    }

}
