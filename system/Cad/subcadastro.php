<?php

class Cad_SubCadastro extends Cad_Cadastro {

    public $tag;
    public $subCadastropks = array();

    public function __construct($tag, $nomePrograma, $tableName, $fields = "*") {
        parent::__construct($nomePrograma, $tableName, $fields);
        $this->tag = $tag;
    }

    public function addPk($pk, $v) {
        $this->subCadastropks[$pk] = $v;
    }

    public function getSubCadastroURL($tag="", $tagaction="") {
        $qryStr = "";
        foreach ($this->subCadastropks as $k => $v) {
            $qryStr.="&pk[" . $k . "]=" . $v;
        }

        return "/".Map::$area . "/". Map::$modulo . "/".Map::$acao."?tag=" . $tag . "&ta=" . $tagaction . $qryStr;
    }

    public function build() {
        $tagaction = isset($_GET['ta']) ? strtolower($_GET['ta']) : "marca-grid";
        switch ($tagaction) {
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

                $m = isset($_GET['m']) ? $_GET['m'] : "index";
                $a = isset($_GET['a']) ? $_GET['a'] : "";
                
                 ?>
<script>
    top.grid<?= $this->tag; ?>();
    top.$.facebox('<?=System_MSG::get('CAD0007')?>');
    </script>
<?php
                //HTTP::redirect($this->getSubCadastroURL()."&msg=CAD0007#".$this->tag);
                break;
                case 'grid':
                    
                $this->buildGrid();
                    break;
            default:
                $this->marcaGrid();
                break;
        }
    }

    public function buildEditForm() {

        foreach ($_GET['pk'] as $fieldName => $value) {
            $where = ($fieldName . " = '" . $value . "'");
        }
        if ($_POST) {
            if ($this->fieldsets[0]->update($where)) {
                $m = isset($_GET['m']) ? $_GET['m'] : "index";
                $a = isset($_GET['a']) ? $_GET['a'] : "";
                ?>
<script>
    top.grid<?= $this->tag; ?>();
    top.$.facebox('<?=System_MSG::get('CAD0006')?>');
    </script>
<?php
                
                //HTTP::redirect($this->getSubCadastroURL()."&msg=CAD0006#".$this->tag);
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
            if (!$this->fieldsets[0]->insert()) {
                foreach ($this->fieldsets[0]->fields as $k => $f) {
                    $f->value = $f->getPostValue();
                    $this->fieldsets[0]->fields[$k] = $f;
                }
            } else {
                $m = isset($_GET['m']) ? $_GET['m'] : "index";
                $a = isset($_GET['a']) ? $_GET['a'] : "";
                ?>
                <script>
                    top.grid<?= $this->tag; ?>();
                    top.$.facebox('<?=System_MSG::get('CAD0005')?>');
                    </script>
                <?php
                //HTTP::redirect($this->getSubCadastroURL()."&msg=CAD0005#".$this->tag);
                exit;
            }
        }
        $this->row = array();
        $this->acao = "insert";
        $this->buildForm();
    }

    public function buildForm() {
        $this->getFile("cad/subcadastro/form.php");
    }

    public function buildGrid() {

        $ado = new Ado($this->fieldsets[0]->tableName);
        $ado->select = $this->fieldsets[0]->selectFields;

        foreach ($this->join as $join) {
            $ado->join($join['table'], $join['condition'], $join['fields'], $join['joinType']);
        }

        if (count($this->where) > 0)
            $ado->where = "(" . implode(" AND ", $this->where) . ")";


        $this->gridFields = $this->fieldsets[0]->fields;
        $this->gridData = $ado->getPaginated();

        $this->getFile("cad/subcadastro/grid.php");
    }
    public function marcaGrid() {
        $this->getFile("cad/subcadastro/marca-grid.php");
    }

}
