<?php

class DB_Model extends DB {

    public $modelparams = array();

    /*
     * Caso consulta base envolva algum JOIN, deve ser configurado neste 
     * parâmetro
     */

    public function __construct($nomeTabela = "") {
        parent::__construct($nomeTabela);
    }

    public function __set($nome, $valor) {
        $this->modelparams[$nome] = $valor;
    }

    public function __get($nome) {
        return $this->exists($nome) ? $this->modelparams[$nome] : "";
    }

    public function clear() {
        $this->modelparams = array();
    }

    public function exists($nome) {
        return isset($this->modelparams[$nome]);
    }

    public function setId($id) {
        $chavePrimaria = $this->chavePrimaria;
        $this->$chavePrimaria = $id;
    }

    public function getId() {
        $chavePrimaria = $this->chavePrimaria;
        return $this->$chavePrimaria;
    }
    
    public function deleteById($id="") {
        if(!empty($id)) $this->setId ($id);
        $chavePrimaria = $this->chavePrimaria;
        return $this->delete($chavePrimaria." = '".$this->getId()."'");
    }

    /*
     * TODO - Normalizar a consulta base em um método único
     */

    public function getRow($where = "", $type = "model") {
        if (!empty($where))
            $this->where($where);

        $sql = $this->getSelect();

        return parent::getRow($sql, $type);
    }

    public function getRows($where = "", $type = "model") {
        if (!empty($where))
            $this->where($where);

        $sql = $this->getSelect();

        return parent::getRows($sql, $type);
    }

    public function count($where = "") {
        if (!empty($where))
            $this->where($where);

        $select = $this->select;
        $this->select = "count(1) num ";
        $num = $this->getRow()->num;
        $this->select = $select;
        return $num;
    }

    public function getPagination($paramPagina = "pg") {
        $DBPagination = new DB_Pagination($this, $paramPagina);
        return $DBPagination;
    }

    /*
     * TODO - Validar se existe configuração de auto-numeração para a tabela
     */

    public function salva() {
        if ($this->antesDeSalvar()) {
            if (isset($this->modelparams[$this->chavePrimaria]) && !empty($this->modelparams[$this->chavePrimaria])) {
                /*
                 * Move dados para instância local
                 */
                $chavePrimaria = $this->chavePrimaria;
                $valorChavePrimaria = $this->modelparams[$chavePrimaria];
                $getBy = "getBy" . $chavePrimaria;

                //verifica na base se existe registro para o ID informado.
                if (!$this->$getBy($valorChavePrimaria)) {
                    //insere, pois não achou registro com o valor do registro
                    if ($this->antesDeInserir())
                        return $this->insert($this->modelparams);
                } else {
                    //~faranjos
                    //se existir apenas uma posição no array significa que está tentando excluir 
                    // visto que essa posição é a chave primária (condição testada no inicio da funcion salva)
                    if (count($this->modelparams) == 1) {
                        //~faranjos
                        //exclui pela chave primária

                        if ($this->antesDeExcluir())
                            return $this->delete($chavePrimaria . " = '" . $valorChavePrimaria . "'");
                    } else {
                        //remove chave primária do Update, evita problema com InnoDB
                        unset($this->modelparams[$chavePrimaria]);

                        //executa UPDATE
                        if ($this->antesDeEditar())
                            return $this->update($this->modelparams, $chavePrimaria . " = '" . $valorChavePrimaria . "'");
                    }
                }
            } else {
                //Caso não tenha sido informado o campo ref. a chave primária só insere
                if ($this->antesDeInserir())
                    return $this->insert($this->modelparams);
            }
        }
        return false;
    }

    public function __call($name, $arguments) {
        //$this->clear();
        if (preg_match("/getById/", $name)) {
            $name = "getBy" . $this->chavePrimaria;
        }
        if (preg_match("/countById/", $name)) {
            $name = "countBy" . $this->chavePrimaria;
        }

        if (preg_match("/getBy/", $name)) {
            $fieldName = preg_replace("/getBy/", "", $name);
            if (preg_match("/__/", $fieldName)) {
                $fields = explode("__", $fieldName);
                $where = " 1=1 ";
                foreach ($fields as $k => $v) {
                    $where.=" AND " . $this->nomeTabela . "." . $v . " = '" . $arguments[$k] . "'";
                }
            }
            else
                $where = $this->nomeTabela . "." . $fieldName . " = '" . $arguments[0] . "'";

            $this->where($where);
            return $this->getRow();
        }
        if (preg_match("/countBy/", $name)) {
            $this->select = "count(1) num ";

            $fieldName = preg_replace("/countBy/", "", $name);
            if (preg_match("/__/", $fieldName)) {
                $fields = explode("__", $fieldName);
                $where = " 1=1 ";
                foreach ($fields as $k => $v) {
                    $where.=" AND " . $this->nomeTabela . "." . $v . " = '" . $arguments[$k] . "'";
                }
                return $this->getRow($where)->num;
            }
            return $this->getRow($this->nomeTabela . "." . $fieldName . " = '" . $arguments[0] . "'")->num;
        }
        if (preg_match("/getAllBy/", $name)) {
            $fieldName = preg_replace("/getAllBy/", "", $name);
            if (preg_match("/__/", $fieldName)) {
                $fields = explode("__", $fieldName);
                $where = " 1=1 ";
                foreach ($fields as $k => $v) {
                    $where.=" AND " . $this->nomeTabela . "." . $v . " = '" . $arguments[$k] . "'";
                }
                return $this->getRows($where);
            }
            return $this->getRows($fieldName . " = '" . $arguments[0] . "'");
        }


        Error::show("Falha ao executar pesquisa ($name, " . print_r($arguments, 1) . ")", 0);
    }

    public function antesDeSalvar() {
        return true;
    }

    public function antesDeEditar() {
        return true;
    }

    public function antesDeInserir() {
        return true;
    }

    public function antesDeExcluir() {
        return true;
    }
    
    /*Folders*/
    static $folders = array();
    static function addFolder($path) {
        self::$folders[] = $path;
    }
    static function getFolders() {
        return self::$folders;
    }

}
