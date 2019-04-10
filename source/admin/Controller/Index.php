<?php

class Controller_Index extends System_Controller {

    public function index() {}
    
    public function dadosDeAcesso() {

        if (HTTP::isPost()) {
            $ModelSenha = new Model_Senha();
            $Senha = $ModelSenha->getById(Security::get('ID'));
            $Senha->LOGIN = $_POST['LOGIN'];
            $Senha->SENHA = $_POST['SENHA'];
            $Senha->salva();
            
            Error::add("SS0001");
        }

        $ModelSenha = new Model_Senha();
        $this->senha = $ModelSenha->getById(Security::get('ID'));
    }

    public function indicadores() {
        $Indicadores = new Model_Indicadores();

        if (isset($_GET['excluir'])) {
            $Indicadores = new Model_Indicadores();
            $Indicadores->deleteById($_GET['excluir']);
        }
        if ($_POST) {
            foreach ($_POST['row']['Ordem'] as $k => $Ordem) {
                $Usuario_Nome = $_POST['row']['Usuario_Nome'][$k];

                $Indicadores = new Model_Indicadores();
                if ($Ordem != "novo") {
                    $serv = $Indicadores->getById($Ordem);
                    if ($serv) {
                        $serv->Usuario_Nome = $Usuario_Nome;
                        $serv->salva();
                    }
                } else {
                    if (!empty($Usuario_Nome)) {
                        $Indicadores = new Model_Indicadores();
                        $Indicadores->Usuario_Nome = $Usuario_Nome;
                        $Indicadores->salva();
                    }
                }
            }
        }

        $Indicadores = new Model_Indicadores();
        $this->indicadores = $Indicadores->getRows();
    }
    
    public function senha() {
        $Senha = new Model_Senha();

        if (isset($_GET['excluir'])) {
            $Senha = new Model_Senha();
            $Senha->deleteById($_GET['excluir']);
        }
        if ($_POST) {
            foreach ($_POST['row']['ID'] as $k => $id) {
                $Nome = $_POST['row']['NOME'][$k];
                $Login = $_POST['row']['LOGIN'][$k];
                $UsuarioSenha = $_POST['row']['SENHA'][$k];

                $Senha = new Model_Senha();
                if ($id != "novo") {
                    $serv = $Senha->getById($id);
                    if ($serv) {
                        //NOME, LOGIN, SENHA
                        $serv->NOME = $Nome;
                        $serv->LOGIN = $Login;
                        $serv->SENHA = $UsuarioSenha;
                        $serv->salva();
                    }
                } else {
                    if (!empty($Nome)) {
                        $Senha = new Model_Senha();
                        $Senha->NOME = $Nome;
                        $Senha->LOGIN = $Login;
                        $Senha->SENHA = $UsuarioSenha;
                        $Senha->salva();
                    }
                }
            }
        }
        

        $Senha = new Model_Senha();
        $this->senhas = $Senha->getRows();
    }

    public function init() {
        $this->setTitle("CursosAMais");
        
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
