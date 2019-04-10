<?php

class Cad_Cadastro extends Template {

    public $nomePrograma;
    public $tabela = "";
    public $campos = array();
    public $fieldsetId;
    public $fieldsets = array();
    public $msg = array();
    public $pks = array();
    public $join = array();
    public $where = array();
    public $orderby = array();
    public $subCadastros = array();
    public $inibirGrid = false;

    /* PERMISSÕES */
    public $permiteIncluir = true;
    public $permiteAlterar = true;
    public $permiteExcluir = true;

    public function __construct($nomePrograma, $tableName, $fields = "*") {
        $this->nomePrograma = $nomePrograma;
        $this->tabela = $tableName;

        $this->newFieldset($nomePrograma, $tableName);

        System_MSG::add("CAD1001", "Incluir");
        System_MSG::add("CAD1002", "Salvar");
        System_MSG::add("CAD1004", "Não há registros");
        System_MSG::add("CAD0005", "Cadastro efetuado com sucesso");
        System_MSG::add("CAD0006", "Cadastro alterado com sucesso");
        System_MSG::add("CAD0007", "Cadastro excluido com sucesso");
    }

    public function addSubCadastro($tag, $subCadastro) {
        $this->subCadastros[preg_replace("/[^0-9a-zA-Z]/", "", $tag)] = $subCadastro;
    }

    public function getMsg($codMsg) {
        return System_MSG::get($codMsg);
    }

    public function addCampo($campo) {
        $this->campos[] = $campo;
    }

    public function getFieldset() {
        return $this->fieldsets[$this->fieldsetId];
    }

    public function newFieldset($legend, $tableName, $fields = "*", $fieldsetDescription = "") {
        $fieldsetDescription = empty($fieldsetDescription) ? $legend : $fieldsetDescription;
        $this->fieldsetId = count($this->fieldsets);
        $this->fieldsets[$this->fieldsetId] = new Cad_Fieldset($legend, $fieldsetDescription);
        $this->fieldsets[$this->fieldsetId]->tableName = $tableName;
        $this->fieldsets[$this->fieldsetId]->selectFields = $fields;
    }

    public function getSubMenu($params = array()) {
        if ($this->fileExists(Map::$modulo . "/sub-menu.php")) {
            $this->getFile(Map::$modulo . "/sub-menu.php");
            return true;
        }
    }

    public function addFiltro($f, $template = "standart") {
        $f->setTemplate($template);
        if ($f->typeField == "select" && !$f->is_set("naoExibirTodos")) {
            $f->addOption("", "Todos");
        }


        $this->fieldsets[$this->fieldsetId]->addFiltro($f);

        $fieldName = $f->fieldName;
        /*print_r($_GET);
        echo "entrou";
        exit;*/
        if (isset($_GET[$f->fieldName]) && !empty($_GET[$f->fieldName])) {

            $f->value = $_GET[$f->fieldName];
            if ($f->typeField == "select") {
                $this->where($f->getTable($this->tabela) . "." . $fieldName . " = '" . $_GET[$f->fieldName] . "'");
            } else {
                $this->where($f->getTable($this->tabela) . "." . $fieldName . " LIKE '%" . $_GET[$f->fieldName] . "%'");
            }
        }
    }

    public function where($w) {
        $this->where[] = $w;
    }

    public function addField($f) {
        if ($f->primaryKey) {
            $this->pks[] = $f;
            $f->updateField = false;
        }

        if ($f->obrigatorio) {
            $this->addMsg($f->fieldName, "Campo " . $f->Label . " deve ser preenchido");
        }

        $this->fieldsets[$this->fieldsetId]->addField($f);
    }

    public function buildQueryPK($row) {
        $qry = "";
        if (is_array($this->pks) && is_int($row)) {
            foreach ($this->pks as $pk) {
                $fn = $pk->fieldName;
                $qry.= empty($qry) ? "pk[" . $fn . "]=" . $row : "&pk[" . $fn . "]=" . $row;
            }
        }
        if (is_array($this->pks) && is_object($row))
            foreach ($this->pks as $pk) {
                $fn = $pk->fieldName;
                $qry.= empty($qry) ? "pk[" . $fn . "]=" . $row->$fn : "&pk[" . $fn . "]=" . $row->$fn;
            }

        return $qry;
    }

    public function getJsModule() {
        
    }

    public function build() {

        if (isset($_GET['tag']) && !empty($_GET['tag'])) {
            $tag = $_GET['tag'];
            call_user_func_array($this->subCadastros[$tag], array($tag, $this));
        } else {
            $c = Map::exists('acao-cadastro') ? Map::get('acao-cadastro') : "grid";

            if ($this->inibirGrid) {
                if ($c != "edit") {
                    $c = "edit";
                    $url = "/" . Map::$area . "/" . Map::$modulo . "/" . Map::$acao . "/acao-cadastro/edit/?";
                    foreach ($this->fieldsets[0]->fields as $field) {
                        if ($field->primaryKey) {
                            $pk[] = "pk[" . $field->fieldName . "]=" . $field->value;
                        }
                    }
                    if (is_array($pk))
                        $url.=implode("&", $pk);

                    HTTP::redirect($url);
                    exit;
                }
            }

            System_Log::logit("Build Cadastro", $c);
            switch ($c) {
                case 'insert':
                    $this->buildInsertForm();
                    break;
                case 'edit':
                    $this->buildEditForm();
                    break;
                case 'delete':
                    foreach ($_GET['pk'] as $fieldName => $value) {
                        $where = ($fieldName . " = '" . $value . "'");
                    }
                    $this->fieldsets[0]->delete($where);


                    $m = isset(Map::$modulo) ? Map::$modulo : "index";
                    $a = isset(Map::$acao) ? Map::$acao : "";
                    HTTP::redirect(Map::$area . "/" . $m . "/" . $a . "?msg=CAD0007");
                    break;
                default:
                    $this->buildGrid();
                    break;
            }
        }
    }

    public function buildEditForm() {
        $where = "";
        if (isset($_GET['pk']))
            foreach ((array) $_GET['pk'] as $fieldName => $value) {
                $where = ($fieldName . " = '" . $value . "'");
            }
        if ($_POST) {
            if ($this->fieldsets[0]->update($where)) {
                HTTP::redirect("/" . Map::$area . "/" . Map::$modulo . "/" . Map::$acao . "?" . "msg=CAD0006");
                exit;
            }
        }

        $this->fieldsets[0]->getRow($where);

        $this->row = $this->fieldsets[0]->row;
        $this->acao = "edit";
        $this->buildForm();
    }

    public function buildInsertForm() {
        if (HTTP::isPost()) {
            $qry = "";
            if (isset($_GET['CO'])) {
                $qry = "&CO=" . $_GET['CO'];
            }

            if (!$pk = $this->fieldsets[0]->insert()) {
                foreach ($this->fieldsets[0]->fields as $k => $f) {
                    $f->value = $f->getPostValue();
                    $this->fieldsets[0]->fields[$k] = $f;
                }
            } else {

                $m = isset(Map::$modulo) ? Map::$modulo : "index";
                $a = isset(Map::$acao) ? Map::$acao : "";
                $c = "";
                if (is_array($this->subCadastros) && count($this->subCadastros) > 0)
                    $c = "edit";
                HTTP::redirect("/" . Map::$area . "/" . $m . "/" . $a . "/" . $c . "?msg=CAD0005&" . $this->buildQueryPK($pk) . $qry);
                exit;
            }
        }
        $this->row = array();
        $this->acao = "insert";
        $this->buildForm();
    }

    public function buildForm() {
        $this->getFile("cad/form.php");
    }

    public function joinLeft($table, $condition, $fields) {
        $this->join($table, $condition, $fields, "LEFT JOIN");
    }

    public function joinRight($table, $condition, $fields) {
        $this->join($table, $condition, $fields, "RIGHT JOIN");
    }

    public function join($table, $condition, $fields = "*", $joinType = "INNER JOIN") {
        $this->join[] = array('table' => $table, 'condition' => $condition, 'fields' => $fields, 'joinType' => "LEFT JOIN");
    }

    public function buildGrid() {
        $ado = new Ado($this->fieldsets[0]->tableName);
        $ado->select = $this->fieldsets[0]->selectFields;

        foreach ($this->join as $join) {
            $ado->join($join['table'], $join['condition'], $join['fields'], $join['joinType']);
        }

        if (count($this->where) > 0)
            $ado->where = "(" . implode(" AND ", $this->where) . ")";

        if (!empty($this->orderby))
            $ado->orderby = $this->orderby;

        $this->gridFields = $this->fieldsets[0]->fields;

        $this->gridData = $ado->getPaginated();

        $this->getFile("cad/grid.php");
    }

}

?>