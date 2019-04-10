<?php

class Controller_Professores extends System_Controller {

    public function index() {
        //SELECT DISTINCT usuario_nome, ordem FROM usuarios WHERE tipo = 'awersaw' ORDER BY usuario_nome

        $ModelUsuarios = new Model_Usuarios();
        $ModelUsuarios->where("tipo = 'awersaw'");
        $ModelUsuarios->orderby("usuario_nome");
        $ModelUsuarios->groupby("usuario_nome");

        $this->usuarios = $ModelUsuarios->getRows();
    }

    public function getData() {
        $vet = $_POST;
        return $vet;
    }

    public function add() {
        
        if (HTTP::isPost()) {

            $post = $_POST;

            if (isset($_FILES['foto_aluno']) && $_FILES['foto_aluno']['size'] > 0) {
                $post['foto_aluno'] = $_FILES['foto_aluno']['name'];
                $tmp = $_FILES['foto_aluno']['name'];
                $dir = System_CONFIG::get('upload_dir');

                move_uploaded_file($_FILES['foto_aluno']['tmp_name'], $dir . $tmp);
            }


            $usuario = new Model_Usuarios();

            foreach ($post as $k => $v) {
                $usuario->$k = $v;
            }
            
            $usuario->tipo = 'awersaw';

            $id = $usuario->salva();
            
            
            Error::add("PRO0003");
            HTTP::redirect($this->url("admin", "professores", "edit", array("id" => $id)));
        }


        $ModelUsuarios = new Model_Usuarios();
        $this->usuario = $ModelUsuarios;
        $this->render("form");
    }

    public function edit() {

        if (HTTP::isPost()) {

            $post = $_POST;
            if (isset($post['ifoto_aluno'])) {
                $post['foto_aluno'] = $post['ifoto_aluno'];
                unset($post['ifoto_aluno']);
            }

            if (isset($_FILES['foto_aluno']) && $_FILES['foto_aluno']['size'] > 0) {
                $post['foto_aluno'] = $_FILES['foto_aluno']['name'];
                $tmp = $_FILES['foto_aluno']['name'];
                $dir = System_CONFIG::get('upload_dir');

                move_uploaded_file($_FILES['foto_aluno']['tmp_name'], $dir . $tmp);
            }


            $ModelUsuarios = new Model_Usuarios();
            $usuario = $ModelUsuarios->getById(Map::get('id'));

            foreach ($post as $k => $v) {
                $usuario->$k = $v;
            }

            $usuario->salva();
            
            
            Error::add("PRO0002");
        }

        $ModelUsuarios = new Model_Usuarios();
        $this->usuario = $ModelUsuarios->getById(Map::get('id'));


        $this->render("form"

            );
    }

    public function delete() {
        $ModelUsuarios = new Model_Usuarios();
        //$usuario = $ModelUsuarios->getById();
        $ModelUsuarios->delete("Ordem = '" . Map::get('id') . "'");

        Error::add("PRO0001");

        HTTP::redirect($this->url("admin ", "professores

            "));
    }

    public function init() {
        if(!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
