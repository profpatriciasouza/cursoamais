<?php

class Controller_Modulos extends System_Controller {

    public function index() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;

        $ModelFeedback = new Model_Feedback();
        $this->feedbacks = $ModelFeedback->getAllByproduto($smodulo->modulo->curso);


        $ModelFeedback = new Model_Feedback();
        $ModelFeedback->join("modulos", explode(",", "id as modid, curso,disciplina,codigo_professor,professor_email,Professor,texto,materia1,materia2,materia3,materia4,materia5,materia6,materia7,materia8,materia9,materia10,video1,video2,video3,video4,video5,video6,video7,video8,video9,video10,aula1,aula2,aula3,oqueler,conteudo,valor,vencimento,link1,link2,link3,dlink1,dlink2,dlink3,linkvalor,exercicio1,exercicio2,exercicio3,exercicio4,exercicio5,avaliacaofinal"));
        if (Security::get('tipo') == 'awersaw')
            $ModelFeedback->where("modulos.codigo_professor = '" . Security::get('codigo_professor') . "'");

        if (Security::get('tipo') == 'ueisyes') {
            $smodulo = new Security("modulo");
            $this->modulo = $smodulo->modulo;
            $ModelFeedback->where("modulos.id = '" . $this->modulo->id . "'");
        }
        $ModelFeedback->limit(5);
        $this->feedbacks = $ModelFeedback->getRows();


        $ModelMural = new Model_Mural();
        $this->murais = $ModelMural->getAllByproduto($smodulo->modulo->curso);
    }

    public function foto() {
        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
            $dir = System_CONFIG::get("upload_dir");
            $filename = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $_FILES['foto']['name']);

            $file = $filename;
            
            $tmp = $_FILES['foto']['tmp_name'];

            $i = 1;
            while (file_exists($dir . $file)) {
                $file = $i . "_" . $filename;
                $i++;
            }
            

            move_uploaded_file($tmp, $dir . $file);
            $ModelUsuario = new Model_Usuarios;
            $usuario = $ModelUsuario->getById(Security::get('Ordem'));
            $usuario->foto = $file;
            
            $usuario->salva();
            $usuario = $ModelUsuario->getById(Security::get('Ordem'));
            Security::registerUser($usuario);
        }
        
        Error::add('FOT0001');
        HTTP::redirect($this->url('alunos', 'modulos'));
    }

    public function sobre() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function inaugural() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function materia() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function apostilasVirtuais() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function videos() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function leiturasIndicadas() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function exercicios() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;
    }

    public function tutor() {
        $smodulo = new Security("modulo");

        $this->modulo = $smodulo->modulo;

        $ModelUsuarios = new Model_Usuarios;
        $this->professor = $ModelUsuarios->getBycodigo_professor($this->modulo->codigo_professor);
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

        $smodulo = new Security("modulo");
        $this->modulo = $smodulo->modulo;

        $ModelMensagens = new Model_Mensagens;
        $ModelMensagens->orderby("data DESC");
        $ModelMensagens->where("destinatario = '" . Security::get('Usuario_Email') . "'");
        $this->mensagens = $ModelMensagens->getRows();

        $ModelMensagens = new Model_Mensagens;
        $ModelMensagens->where("remetente = '" . Security::get('Usuario_Email') . "'");
        $ModelMensagens->orderby("data DESC");
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

    public function enviarAvaliacao() {

        $smodulo = new Security("modulo");
        $this->modulo = $smodulo->modulo;

        $ModelCursos = new Model_Cursos;
        $this->curso = $ModelCursos->getById($this->modulo->curso);


        $ModelUpload = new Model_Upload();
        $upload = $ModelUpload->getBydisciplina__codigo_aluno($this->modulo->id, Security::get('codigo_aluno'));
        if (HTTP::isPost() || $_FILES) {
            if (!$upload) {
                $upload = new Model_Upload();
                $upload->disciplina = $this->modulo->id;
                $upload->codigo_aluno = Security::get('codigo_aluno');
                $upload->codigo_professor = $this->modulo->codigo_professor;
                $upload->codigo_professor = $this->modulo->codigo_professor;
                $upload->data = date("d/m/Y");
                $upload->hora = date("H:i");
                $upload->tipo = "e";
            }

            $upload->arquivo = HTTP::getPost('iarquivo');

            if (isset($_FILES['arquivo']) && $_FILES['arquivo']['size'] > 0) {
                $dir = System_CONFIG::get("upload_dir");
                $filename = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $_FILES['arquivo']['name']);
                $file = $filename;
                $tmp = $_FILES['arquivo']['tmp_name'];

                $i = 1;
                while (file_exists($dir . $file)) {
                    $file = $i . "_" . $filename;
                    $i++;
                }

                move_uploaded_file($tmp, $dir . $file);
                $upload->arquivo = $file;
            }

            $upload->salva();

            if ($upload->arquivo != "") {

                $Corpo = "Enviado por.: " & Security::get("Usuario_Nome") . "<br />";
                $Corpo.= $Corpo . "Email : " & Security::get("Usuario_Email") . "<br />";
                $Corpo.= $Corpo . "Curso : " . Encoding::utf8($this->curso->titulo_curso);
                $Corpo.= $Corpo . "Módulo : " . Encoding::utf8($this->modulo->disciplina);

                $mail = new Mailer();
                $mail->IsMail();
                $mail->SMTPAuth = false;
                $mail->From = "atendimento@cursosamais.com.br";
                $mail->FromName = "Atendimento";
                $mail->AddAddress($this->modulo->professor()->Usuario_Email);
                $mail->IsHTML(true);

                if (!$mail->enviar("secretaria@cursosamais.com.br", "Envio de arquivo", $Corpo)) {
                    echo "erro";
                }
            }

            //iarquivo
        }
        $ModelUpload = new Model_Upload();
        $upload = $ModelUpload->getBydisciplina__codigo_aluno($this->modulo->id, Security::get('codigo_aluno'));
        $this->upload = $upload;
    }

    public function notas() {
        $ModelUsuariosCurso = new Model_UsuariosCursos;
        $this->usuarioCurso = $ModelUsuariosCurso->getBycodigo_aluno(Security::get("codigo_aluno"));

        $ModelCursos = new Model_Cursos;
        $this->curso = $ModelCursos->getById($this->usuarioCurso->Produto);

        $ModelModulos = new Model_Modulos;
        $this->modulos = $ModelModulos->getAllBycurso($this->usuarioCurso->Produto);
    }

    public function certificado() {

        $ModelUsuariosCurso = new Model_UsuariosCursos;
        $this->usuarioCurso = $ModelUsuariosCurso->getBycodigo_aluno(Security::get("codigo_aluno"));

        $ModelCursos = new Model_Cursos;
        $this->curso = $ModelCursos->getById($this->usuarioCurso->Produto);

        $ModelModulos = new Model_Modulos;
        $this->modulos = $ModelModulos->getAllBycurso($this->usuarioCurso->Produto);


        $Corpo = "Enviado por.: " & Security::get("Usuario_Nome") . "<br />";
        $Corpo.= $Corpo . "Email : " & Security::get("Usuario_Email") . "<br />";
        $Corpo.= $Corpo . "Curso : " . Encoding::utf8($this->curso->titulo_curso);

        $mail = new Mailer();
        $mail->IsMail();
        $mail->SMTPAuth = false;
        $mail->From = "atendimento@cursosamais.com.br";
        $mail->FromName = "Atendimento";
        $mail->IsHTML(true);

        if (!$mail->enviar("atendimento@cursosamais.com.br", "Solicitação de Certificado", $Corpo)) {
            echo "erro";
        }
    }

    public function seleciona() {

        $ModelModulos = new Model_Modulos();
        $modulo = $ModelModulos->getById(Map::get('id'));

        if ($modulo) {
            $smodulo = new Security("modulo");
            $smodulo->modulo = $modulo;

            HTTP::redirect($this->url("alunos", "modulos"));
        }
    }

    public function init() {
        $this->setTitle("CursosAMais");

        Error::addMsg("DU0001", "Mensagem respondida com sucesso");
        Error::addMsg("DU0002", "Mensagem enviada com sucesso");

        $avisos = false;
        $smodulo = new Security("modulo");
        if ($smodulo->modulo != "" && Security::get('tipo') != 'awersaw' && Security::get('tipo') != 1) {
            $ModelAvisos = new Model_Avisos;
            $ModelAvisos->where("aviso = 'a'");
            $ModelAvisos->where("dequem = '" . $smodulo->modulo->professor()->Ordem . "'");
            $this->avisosEspecificos = $ModelAvisos->getRows();

            if ($this->avisosEspecificos) {
                foreach ($this->avisosEspecificos as $aviso) {
                    if (strpos($aviso->codigo_aluno, Security::get('codigo_aluno')) !== false) {
                        $avisos[] = $aviso;
                    }
                }
            }

            $ModelAvisos = new Model_Avisos;
            $ModelAvisos->where("aviso = 'm'");
            $ModelAvisos->where("dequem = '" . $smodulo->modulo->professor()->Ordem . "'");
            $this->avisosModulos = $ModelAvisos->getRows();
            if ($this->avisosModulos) {
                foreach ($this->avisosModulos as $modulo) {
                    if (strpos($modulo->codigo_aluno, $smodulo->modulo->id) !== false) {
                        $avisos[] = $modulo;
                    }
                }
            }
        }


        $this->avisos = $avisos;


        if (!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
