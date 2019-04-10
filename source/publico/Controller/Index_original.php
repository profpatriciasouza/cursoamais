 <?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema, que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Index extends System_Controller {

    public function index() {
        if (!Security::hasAccess()) {
            HTTP::redirect($this->url("login"));
        }

        if (Security::get('tipo') == 'awersaw') {
            HTTP::redirect($this->url("professor"));
        }
        if (Security::get('tipo') == 'ueisyes') {
            HTTP::redirect($this->url("alunos", "dashboard"));
        }

        HTTP::redirect($this->url("admin"));
    }

    public function login() {

        if ($_POST) {
            $ModelSenha = new Model_Senha();
            $ModelSenha->where("LOGIN = '" . $_POST['Usuario'] . "'");
            $ModelSenha->where("SENHA = '" . $_POST['senha'] . "'");
            $senha = $ModelSenha->getRow();

            if ($senha) {
                $senha->tipo = 1;
                Security::registerUser($senha);

                HTTP::redirect($this->url("admin"));
            }
            $ModelUsuarios = new Model_Usuarios();
            $ModelUsuarios->where("Usuario_login = '" . $_POST['Usuario'] . "'");
            $ModelUsuarios->where("Usuario_Senha = '" . $_POST['senha'] . "'");
            
            /*echo $ModelUsuarios->getSelect();
            exit;*/

            $usuario = $ModelUsuarios->getRow();
            if ($usuario && $usuario->Usuario_Senha == $_POST['senha']) {
                $id = $usuario->Ordem;
                $usuario->QuantidadeAcessos = $usuario->QuantidadeAcessos + 1;
                $usuario->salva();
                $usuario->Ordem = $id;

                Security::registerUser($usuario);

                if ($usuario->tipo == "awersaw") {
                    HTTP::redirect($this->url("professor"));
                } else {


                    $ModelUsuariosCursos = new Model_UsuariosCursos;
                    $ModelUsuariosCursos->orderby("Validade_Assinatura DESC");
                    $UsuarioCurso = $ModelUsuariosCursos->getBycodigo_aluno($usuario->codigo_aluno);
                    

                    if (time() > strtotime($UsuarioCurso->Validade_Assinatura)) {
                        HTTP::redirect($this->url("index", "validade-assinatura"));
                    }

                    HTTP::redirect($this->url("alunos"));
                }
            }
            Error::add("LOG0001");
        }

        Error::addMsg("LOG0001", "Usuário ou senhas inválidos");
    }
    
    public function esqueciMinhaSenha() {
        if(HTTP::isPost()) {
            $ModelUsuarios = new Model_Usuarios();
            $ModelUsuarios->where("Usuario_Email = '?'", array(HTTP::getPost('Email')));
            $usuario = $ModelUsuarios->getRow();
            
            if(!$usuario) {
                Error::add("LOG0010");
            } else {
                
                $Corpo = "Olá ".$usuario->Usuario_Nome."<br />"
                        . "Você solicitou sua senha através do site http://www.cursosamais.com.br/, segue abaixo seus dados de acesso:<br />"
                        . "<br />"
                        . "<strong>Usuário:</strong> ".$usuario->Usuario_Login
                        . "<br />"
                        . "<strong>Usuário:</strong> ".$usuario->Usuario_Senha;
                
                $mail = new Mailer();
                $mail->IsMail();
                $mail->SMTPAuth = false;
                $mail->From = "atendimento@cursosamais.com.br";
                $mail->FromName = "Atendimento";
                $mail->AddAddress($usuario->Usuario_Email);
                $mail->IsHTML(true);

                if (!$mail->enviar("secretaria@cursosamais.com.br", "Recuperação de senha", $Corpo)) {
                    Error::add("LOG0011");
                } else {
                    Error::add("LOG0012");
                }
            }
        }
        
        
        Error::addMsg("LOG0010", "E-mail não localizado, confirme o email digitado!");
        Error::addMsg("LOG0011", "Falha ao enviar email");
        Error::addMsg("LOG0011", "Um e-mail foi enviado a sua caixa postal com a sua senha");
        Error::addMsg("LOG0012", "E-mail enviado com sucesso!");
    }

    public function logout() {
        $smodulo = new Security("modulo");
        $smodulo->deleteNameSpace();

        Security::revokeAccess();
        HTTP::redirect($this->url("login"));
    }

    public function init() {
        $this->setTitle("Cursos a mais");
    }

}
