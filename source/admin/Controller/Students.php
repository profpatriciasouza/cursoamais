<?php

class Controller_Students extends System_Controller {

    public function index() {
        //SELECT *, usuarios_cursos.produto as cuprod, usuarios_cursos.Validade_Assinatura as cuval, usuarios_cursos.Usuario_DataCadastro as dtcad 
        //FROM usuarios, usuarios_cursos WHERE usuarios.codigo_aluno=usuarios_cursos.codigo_aluno
        $ModelUsuarios = new Model_Usuarios();
        $ModelUsuarios->join("usuarios_cursos", array("*"));
        $ModelUsuarios->orderby("Usuario_Nome ASC");
        if (isset($_GET['filtro']) && !empty($_GET['filtro'])) {
            $ModelUsuarios->where("Usuario_Nome LIKE '%" . $_GET['filtro'] . "%' OR usuarios.Usuario_Login LIKE '%" . $_GET['filtro'] . "%'");
        }
        

        if (Security::get('tipo') == 'awersaw') {

            $destinatarios = "SELECT usuarios.Ordem "
                    . "FROM usuarios_cursos, "
                    . "usuarios, cursos, modulos "
                    . "WHERE usuarios.Tipo = 'ueisyes' AND usuarios_cursos.situacao='S' "
                    . "and usuarios_cursos.codigo_aluno=usuarios.codigo_aluno and "
                    . "usuarios_cursos.produto=cursos.id and cursos.id=modulos.curso and "
                    . "modulos.codigo_professor='" . Security::get('codigo_professor') . "' group by usuarios.usuario_nome, usuarios.usuario_email, usuarios.codigo_aluno  ORDER BY usuario_nome";

            $ModelUsuarios->where("Ordem IN (" . $destinatarios . ")");
        }
        
        $ModelUsuarios->groupby("usuarios_cursos.Id");
        
        $this->alunos = $ModelUsuarios->getRows();
    }

    public function modulos() {

        if (HTTP::isPost()) {


            $ModelUsuarios = new Model_Usuarios();
            $ModelUsuarios->where("Ordem = '" . Map::get('id') . "'");
            $aluno = $ModelUsuarios->getRow();

            $ModelCursos = new Model_UsuariosCursos();
            $ModelCursos->where("codigo_aluno = '" . $aluno->codigo_aluno . "'"); //$ModelCursos->getById($aluno->codigo_aluno);
            $curso = $ModelCursos->getRow();
            $curso->academico = isset($_POST['aprovado']) ? "A" : "";
            $curso->situacao = isset($_POST['ativo']) ? "S" : "";
            if (Security::get('tipo') != 'awersaw')
                $curso->Validade_Assinatura = Plugins_Data::datetimeToDB($_POST['Validade_Assinatura']);

            $curso->salva();


            $ModelModulos = new Model_Modulos();
            $ModelModulos->where("curso = '" . Map::get('curso') . "'");
            if (Security::get('tipo') == 'awersaw')
                $ModelModulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");

            $modulos = $ModelModulos->getRows();


            foreach ($modulos as $modulo) {
                $autorizado = $modulo->autorizado($aluno->codigo_aluno);

                if (Security::get('tipo') != 'awersaw') {
                    $autorizado->liberado = isset($_POST['liberado'][$autorizado->id]) ? "S" : "";
                    $autorizado->pagou = isset($_POST['pagou'][$autorizado->id]) ? "S" : "";
                    $autorizado->academico = isset($_POST['academico'][$autorizado->id]) ? "A" : "";
                }
                $autorizado->nota = $_POST['nota'][$autorizado->id];
                $autorizado->salva();
            }
        }


        $ModelUsuarios = new Model_Usuarios();
        $ModelUsuarios->where("Ordem = '" . Map::get('id') . "'");

        $this->aluno = $ModelUsuarios->getRow();

        $ModelCursos = new Model_Cursos();
        $this->curso = $ModelCursos->getById(Map::get('curso'));

        $ModelModulos = new Model_Modulos();
        $ModelModulos->where("curso = '" . Map::get('curso') . "'");
        if (Security::get('tipo') == 'awersaw')
            $ModelModulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");

        //echo $ModelModulos->getSelect(); exit;
        $this->modulos = $ModelModulos->getRows();


        $ModelUsuariosCursos = new Model_UsuariosCursos;
        $ModelUsuariosCursos->where("codigo_aluno = '" . $this->aluno->codigo_aluno . "'");
        $this->cursos = $ModelUsuariosCursos->getRow();
    }

    public function getData() {
        $vet = $_POST;
        return $vet;
    }

    public function add() {

        if (HTTP::isPost()) {
            $ModelUsuarios = new Model_Usuarios();

            $post = $_POST;

            if ($ModelUsuarios->getByUsuario_Login($post['Usuario_Login'])) {
                Error::add("STU0004");
            } else {


                $ModelUsuariosCursos = new Model_UsuariosCursos;
                foreach ($post['usuarios_cursos'] as $k => $v) {
                    $ModelUsuariosCursos->$k = $v;
                }

                unset($post['usuarios_cursos']);

                foreach ($post as $k => $v) {
                    $ModelUsuarios->$k = $v;
                }
                $id = $ModelUsuarios->salva();

                $usuario = $ModelUsuarios->getById($id);

                $usuario->codigo_aluno = md5($id);
                $usuario->salva();
                $usuario = $ModelUsuarios->getById($id);
                $ModelUsuariosCursos->codigo_aluno = $usuario->codigo_aluno;
                $ModelUsuariosCursos->salva();

                Error::add("STU0001");
                HTTP::redirect($this->url("admin", "students", "edit", array("id" => $id)));
            }
        }

        $ModelUsuarios = new Model_Usuarios();
        $this->aluno = $ModelUsuarios;
        $this->render("form");
    }

    public function edit() {
        if (HTTP::isPost()) {
            $ModelUsuarios = new Model_Usuarios();
            $ModelUsuarios = $ModelUsuarios->getById(Map::get('id'));

            $post = $_POST;

            if (Security::get('tipo') == 'ueisyes') {
                $ModelUsuariosCursos = new Model_UsuariosCursos;
                $ModelUsuariosCursos = $ModelUsuariosCursos->getBycodigo_aluno($ModelUsuarios->codigo_aluno);

                foreach ($post['usuarios_cursos'] as $k => $v) {
                    $ModelUsuariosCursos->$k = $v;
                }

                $ModelUsuariosCursos->salva();
            }unset($post['usuarios_cursos']);



            foreach ($post as $k => $v) {
                $ModelUsuarios->$k = $v;
            }
            $ModelUsuarios->salva();

            Error::add("STU0002");

            HTTP::redirect($this->url("admin", "students", "edit", array("id" => Map::get('id'))));
        }


        $ModelUsuarios = new Model_Usuarios();
        // $ModelUsuarios->join("usuarios_cursos", array("*"));
        $this->aluno = $ModelUsuarios->getById(Map::get('id'));

        if (!$this->aluno)
            HTTP::redirect($this->url("admin", "students"));

        $this->render("form");
    }

    public function historico() {


        $ModelUsuarios = new Model_Usuarios;
        $this->usuario = $ModelUsuarios->getById(Map::get('id'));

        $ModelUsuariosCurso = new Model_UsuariosCursos;
        $this->usuarioCurso = $ModelUsuariosCurso->getBycodigo_aluno($this->usuario->codigo_aluno);


        $ModelCursos = new Model_Cursos;
        $this->curso = $ModelCursos->getById(Map::get('curso'));

        $ModelModulos = new Model_Modulos;
        $ModelModulos->orderby("posicao ASC");
        $this->modulos = $ModelModulos->getAllBycurso(Map::get('curso'));
    }

    public function arquivos() {


        $ModelUsuarios = new Model_Usuarios();
        // $ModelUsuarios->join("usuarios_cursos", array("*"));
        $this->aluno = $ModelUsuarios->getById(Map::get('id'));

        $ModelUpload = new Model_Upload();

        $ModelUpload->where("disciplina = ?", array(Map::get('module')));
        $ModelUpload->where("codigo_aluno = '?'", array(Map::get('ca')));

        $this->uploads = $ModelUpload->getRows();
    }

    public function avaliacoes() {


        $ModelUsuarios = new Model_Usuarios();
        // $ModelUsuarios->join("usuarios_cursos", array("*"));
        $this->aluno = $ModelUsuarios->getById(Map::get('id'));

        $ModelModulosAvaliacao = new Model_ModulosAvaliacao;
        $ModelModulosAvaliacao->where("ava_fk_module = ?", array(Map::get('module')));
        $this->avaliacoes = $ModelModulosAvaliacao->getRows();


        $ModelModulosAutorizado = new Model_ModulosAutorizados;
        $ModelModulosAutorizado->where("iddis = ?", array(Map::get('module')));
        $ModelModulosAutorizado->where("codigo_aluno = '?'", array(Map::get('ca')));
        $this->autorizado = $ModelModulosAutorizado->getRow();

//        var_dump($this->autorizado); exit;
    }

    public function verAvaliacao() {
        $ModelModulosAutorizado = new Model_ModulosAutorizados;
        $this->autorizado = $ModelModulosAutorizado->getById(Map::get('autorizado'));
    }

    public function refazerAvaliacao() {
        $ModelModulosAutorizado = new Model_ModulosAutorizados;
        $this->autorizado = $ModelModulosAutorizado->getById(Map::get('autorizado'));

        $this->autorizado->refazer(Map::get("avaliacao"));
        echo "autorizado";

        $this->render(false);
    }

    public function init() {
        if (!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
