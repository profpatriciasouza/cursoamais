<?php

class System_Controller_Api extends System_Controller {

    public $model = null;
    public $campos = array();
    public $apiMsg = array(
        'add-sucesso' => "Cadastro realizado com sucesso"
        , 'add-erro' => "Falha ao realizar cadastro"
        , 'edit-sucesso' => "Cadastro editado com sucesso"
        , 'edit-erro' => "Erro ao realizar cadastro"
        , 'remove-sucesso' => "Cadastro excluido com sucesso"
        , 'remove-erro' => "Erro ao exlcluir cadastro"
        , 'filter-erro' => "Nenhuma informação encontrada para o filtro selecionado"
    );
    public $rules = null;
    public $validation = null;
    public $autoIncremento;

    public function __construct($Model, $params = array()) {
        $this->model = $Model;
        $this->rules = new API_Rules;
        $this->validation = new API_Validation;

        parent::__construct($params);
        $this->render(false);
    }

    public function api() {
        $this->render(false);
    }

// configurar na classe filha

    public function get() {
        return $this->mapeiaDados($this->model);
    }

    public function filter($msgErro = "") {
        if (!empty($msgErro)) {
            $this->apiMsg['filter-erro'] = $msgErro;
            return;
        }
        foreach ($this->campos as $k => $campo) {
            $campos[] = $campo;
            if (isset($_GET[$k])) {
                $this->model->like($campo, $k);
            }
        }
        if (isset($_GET['s'])) {
            $where = array();
            foreach ($campos as $campo) {
                $where[] = " " . $campo . " LIKE '%" . str_replace(" ", "%", $_GET['s']) . "%'";
            }
            $this->model->where("(" . implode(" OR ", $where) . ")");
        }

        $dados = $this->model->getRows();
        if (!$dados) {
            return array("status" => 0, "message" => $this->apiMsg['filter-erro']);
        }
        foreach ($dados as $dado) {
            $retorno[] = $this->mapeiaDados($dado);
        }
        return array("status" => 1, "dados" => $retorno);
    }

    public function mapeiaDados($dado) {
        $ret['id'] = $dado->getId();
        foreach ($this->campos as $k => $v) {
            $ret[$k] = $dado->$v;
        }
        return $ret;
    }
    
    public function add($msgSucesso = "", $msgErro = "") {
        if (!empty($msgSucesso) && !empty($msgErro)) {
            $this->apiMsg['add-sucesso'] = $msgSucesso;
            $this->apiMsg['add-erro'] = $msgErro;
            return;
        }

        //Se não for POST, não executa
        if (!HTTP::isPost()) {
            return array("status" => 0, "message" => $this->apiMsg['add-erro']);
        }

        //Verifica se ao buscar alguma das regras acusou algum erro
        if ($ret = $this->__getPostData($this->campos['add'])) {
            return $ret;
        }

        if ($this->model->salva()) {
            return array("status" => 1, "message" => $this->apiMsg['add-sucesso']);
        }
        return array("status" => 0, "message" => $this->apiMsg['add-erro']);
    }

    public function edit($msgSucesso = "", $msgErro = "") {
        if (!empty($msgSucesso) && !empty($msgErro)) {
            $this->apiMsg['edit-sucesso'] = $msgSucesso;
            $this->apiMsg['edit-erro'] = $msgErro;
            return;
        }
        
        //Se não for POST, não executa
        if (!HTTP::isPost()) {
            return array("status" => 0, "message" => $this->apiMsg['add-erro']);
        }
        
        //Se ID não estiver setado, não executa
        if(!Map::exists('id')) {
            return array("status" => 0, "message" => $this->apiMsg['add-erro']);
        }
        
        //Verifica se ao buscar alguma das regras acusou algum erro
        if ($ret = $this->__getPostData($this->campos['edit'])) {
            return $ret;
        }
        $this->model->setId(Map::get('id'));

        if ($this->model->salva()) {
            return array("status" => 1, "message" => $this->apiMsg['edit-sucesso']);
        }
        return array("status" => 0, "message" => $this->apiMsg['edit-erro']);
    }
    
    public function prototipoAdd() {
        $this->prototipo('add');
    }
    
    public function prototipoEdit() {
        $this->prototipo('edit');
    }
    
    public function prototipo($acao) {
        $dados = $this->model;
        if ($acao === "edit" && Map::exists('id')) {
            $dados = $this->model->getById(Map::get('id'));
        }

        $id = Map::exists('id') ? array("id" => Map::get('id')) : null;
        $HTMLForm = new HTML_Form("Form", $this->url(Map::$area, Map::$modulo, $acao, $id), "POST");

        $htmls = array();
        foreach ($this->prototipo as $c) {
            $campo = $this->campos[$acao][$c];
            $HTMLInput = new HTML_Input($c, "text", $c, $c, null);
            $HTMLInput->value = $dados->$campo;
            $HTMLForm->addInput($HTMLInput);
        }

        $HTMLForm->add(new HTML_Button("Prototipo", "submit", "Prototipo", "Protótipo"));
        $this->form = $HTMLForm;
        $this->getFile("/api/protipo-add");


        $this->render(false);
    }

    /*
     * Só deve retornar algo em caso de erro
     */

    public function __getPostData($campos) {

        foreach ($campos as $k => $campo) {
            $v = $this->__applyRules($k, HTTP::getPost($k));
            $this->model->$campo = $v;
        }

        if ($this->rules->hasErros()) {
            return array("status" => 3, 'erros' => Error_Form::getJson());
        }
    }

    protected function __applyRules($campo, $valor) {
        if ($this->rules->hasRule($campo)) {
            return $this->rules->apply($campo, $valor);
        }

        return $valor;
    }

    public function delete($msgSucesso = "", $msgErro = "") {
        if (!empty($msgSucesso) && !empty($msgErro)) {
            $this->apiMsg['remove-sucesso'] = $msgSucesso;
            $this->apiMsg['remove-erro'] = $msgErro;
            return;
        }

        //Se não foi informado o ID, não executa a exclusão
        if ($this->model->getId() === "") {
            return array("status" => 0, "message" => $this->apiMsg['remove-erro']);
        }

        if ($this->model->deleteById())
            return array("status" => 1, "message" => $this->apiMsg['remove-sucesso']);


        return array("status" => 0, "message" => $this->apiMsg['remove-erro']);
    }

    public function boot() {
        $this->api();
        if (Map::exists('id')) {
            $this->model = $this->model->getById(Map::get('id'));
        }
    }

    public function finish() {
        echo json_encode($this->retornoAcao);
    }

}
