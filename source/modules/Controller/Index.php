<?php

/*
 * DUET22
 * Implementar na Index apenas funções básicas do sistema,que podem ser aproveitadas
 * em qualquer outro sistema
 */

class Controller_Index extends System_Controller {

    public function index() {
        $ModelModulos = new Model_Modulos();
        $ModelModulos->join("cursos", array("titulo_curso"));
        if (Security::get('tipo') == 'awersaw') {
            $ModelModulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");
        }

        $ModelModulos->orderby("posicao ASC");
        $this->modulos = $ModelModulos->getRows();
    }

    public function save() {
        $ModelModulos = new Model_Modulos();
        $ModelModulosData = new Model_ModulosData;
        if (Map::has('id')) {
            $ModelModulos = $ModelModulos->getById(Map::get('id'));
            $ModelModulosData = $ModelModulosData->getBymodulo(Map::get('id'));

            if (!$ModelModulosData) {
                $ModelModulosData = new Model_ModulosData;
                $ModelModulosData->modulo = Map::get('id');
            }
        }
        $fields = explode(",", "curso,disciplina,codigo_professor,professor_email,Professor,texto,materia1,materia2,materia3,materia4,materia5,materia6,materia7,materia8,materia9,materia10,video1,video2,video3,video4,video5,video6,video7,video8,video9,video10,aula1,aula2,aula3,oqueler,conteudo,valor,vencimento,link1,link2,link3,dlink1,dlink2,dlink3,linkvalor,exercicio1,exercicio2,exercicio3,exercicio4,exercicio5,avaliacaofinal,carga");
        $post = $_POST;

        //inicio, fim, duvidas_de, duvidas_a, entrega_ate
        $ModelModulosData->inicio = Plugins_Data::datetimeToDB(HTTP::getPost('inicio'));
        $ModelModulosData->fim = Plugins_Data::datetimeToDB(HTTP::getPost('fim'));
        $ModelModulosData->duvidas_de = Plugins_Data::datetimeToDB(HTTP::getPost('duvidas_de'));
        $ModelModulosData->duvidas_a = Plugins_Data::datetimeToDB(HTTP::getPost('duvidas_a'));
        $ModelModulosData->entrega_ate = Plugins_Data::datetimeToDB(HTTP::getPost('entrega_ate'));
        $ModelModulosData->salva();

        foreach ($fields as $field) {
            if (isset($post[$field])) {
                $ModelModulos->$field = addslashes($post[$field]);
            }

            if (isset($post["i" . $field])) {
                $ModelModulos->$field = addslashes($post["i" . $field]);
            }
        }

        foreach ($_FILES as $k => $file) {
            $dir = System_CONFIG::get('upload_dir');
            if ($file['size'] > 0) {
                $file['name'] = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $file['name']);
                $name = $file['name'];

                while (file_exists($dir . $name)) {
                    $name = time() . "_" . $file['name'];
                }

                move_uploaded_file($file['tmp_name'], $dir . $name);
                $ModelModulos->$k = $name;
            } else {
                $ModelModulos->$k = HTTP::getPost("i" . $k);
            }
        }

        $id = $ModelModulos->salva();

        return Map::has('id') ? Map::get('id') : $id;
    }

    public function add() {
        if (HTTP::isPost()) {
            $id = $this->save();
            Error::add('MOD0001');
            HTTP::redirect($this->url("modules", "index", "edit", array("id" => $id)));
        }

        $ModelModulos = new Model_Modulos();
        $this->modulo = $ModelModulos;

        $ModelData = new Model_ModulosData;
        $this->data = $ModelData;

        $this->render("form");
    }

    public function edit() {
        if (HTTP::isPost()) {
            $id = $this->save();
            Error::add('MOD0002');
            HTTP::redirect($this->url("modules", "index", "edit", array("id" => $id)));
        }
        $ModelModulos = new Model_Modulos();
        $this->modulo = $ModelModulos->getById(Map::get('id'));

        $smodulo = new Security("modulo");
        $smodulo->modulo = $this->modulo;

        $ModelData = new Model_ModulosData;
        $this->data = $ModelData->getBymodulo($this->modulo->id);
        if (!$this->data) {
            $this->data = new Model_ModulosData;
        }

        $this->render("form");
    }

    public function delete() {
        $ModelModulos = new Model_Modulos();
        if (Map::has('id')) {
            $ModelModulos->deleteById(Map::get('id'));
        }
        Error::add('MOD0003');
        HTTP::redirect($this->url("modules"));
    }

    public function posicao() {
        foreach ($_POST['pos'] as $k => $i) {
            $ModelModulos = new Model_Modulos;
            $ModelModulos->update(array("posicao" => $i), "id = '" . $k . "'");
        }

        Error::add('MOD0004');
        HTTP::redirect($this->urlByAcao("index"));
    }

    public function uploads() {
        $ModelModulos = new Model_Modulos();
        $this->modulo = $ModelModulos->getById(Map::get('id'));
    }

    public function init() {
        if (Security::get('tipo') != 'awersaw' && Security::get('tipo') != 1) {
            HTTP::redirect($this->url("publico"));
        }

        DB_DDL::addField("modulos", "carga", "VARCHAR(120)");

        if (!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
