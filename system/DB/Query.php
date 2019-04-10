<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Query
 *
 * @author lucas
 */
class DB_Query extends DB_Validation {

    public $nomeTabela;
    public $sqlBase = "";

    /* QUERY PROPERTYS */
    protected $sql;
    protected $select;
    protected $from;
    protected $joins;
    protected $limit;
    protected $orderby;
    protected $where;
    protected $groupby;

    public function __construct($nomeTabela = "") {
        if (!empty($nomeTabela))
            $this->nomeTabela = $nomeTabela;

        if (empty($this->from))
            $this->from = $this->nomeTabela;
    }

    /* GERA SELECT */

    public function getSelect() {
        return $this->select() . " " . $this->from() . " " . $this->where() . " " . $this->groupby() . " " . $this->orderby() . " " . $this->limit();
    }

    public function select($select = "") {
        if (!empty($select))
            $this->select = $select;

        $this->select = empty($this->select) ? $this->nomeTabela . ".*" : $this->select;
        return "SELECT " . $this->select;
    }

    public function from() {
        if (empty($this->from)) {
            return "FROM " . $this->nomeTabela;
        }
        return "FROM " . $this->from;
    }

    public function join($tabela, $select = array(), $tipoJoin = "INNER JOIN", $alias = "") {
        $join = $this->joins[$tabela];

        if (is_array($join) && isset($join['alias'])) {
            $tabela = $join['tabela'];
            $alias = $join['alias'];
            $join = $join['join'];
        } else {
            $alias = $tabela;
        }

        if (count($select) > 0) {
            $this->select();
            $this->select.=", " . $alias . "." . implode("," . $alias . ".", $select);
        }
        if (isset($join))
            $this->from.= " " . $tipoJoin . " " . $tabela . " " . ($alias) . " ON " . (is_array($join) ? explode(" AND ", $join) : $join);
    }

    public function clearWhere() {
        $this->where = array();
    }

    public function where($where = "", $params = array()) {
        if (!empty($where))
            $this->where[] = count($params) > 0 ? DB::prepare($where, $params) : $where;

        if (!empty($this->where))
            return is_array($this->where) ? " WHERE (" . implode(") AND (", $this->where) . ")" : " WHERE " . $this->where;
    }

    public function orderby($orderby = "") {
        if (!empty($orderby))
            $this->orderby = $orderby;

        if (!empty($this->orderby))
            return "ORDER BY " . $this->orderby;
    }

    public function groupby() {
        if (!empty($this->groupby))
            return "GROUP BY " . $this->groupby;
    }

    public function limit($limit = "") {
        if ($limit != "") {
            $this->limit = $limit;
        }

        if (!empty($this->limit))
            return "LIMIT " . $this->limit;
    }

    public function getLimit() {
        return $this->limit;
    }

    /* CRUD */

    public function insert($sql) {
        if (is_array($sql)) {
            $select = new DB_Select();
            $select->tableName = $this->nomeTabela;
            $sql = $select->getSelect('insert', $sql);
        }

        $r = DB::query($sql);
        if ($r == true)
            return mysql_insert_id();
        else
            return $r;
    }

    public function update($fields, $sql = "") {
        if (is_array($sql)) {
            Error::show("Falha na atualização de registro, alteração feita na função em 2014-03-02", 0);
        }
        if (empty($fields)) {
            Error::show("Falha na atualização de registro, nenhuma informação foi passada para o UPDATE", 0);
        }
        //SQL também pode ser passada em FIELDS, neste caso deverá ser executada como consulta
        if (is_array($fields)) {
            $where = $sql;

            //construção da query trazida para dentro de DB. Mantido em DB_Select

            $sql = "UPDATE " . $this->nomeTabela . " SET";

            $set = "";
            foreach ($fields as $k => $v) {
                $v= addslashes($v);
                $set.= empty($set) ? " " . $k . " = '" . $v . "'" : "," . $k . " = '" . $v . "'";
            }

            $sql.=$set;

            if (!empty($where))
                $sql.= " WHERE " . $where;
        } else {
            $sql = $fields;
        }
        $r = DB::query($sql);
        return $r;
    }

    public function delete($sql) {
        if (!preg_match("/DELETE/", $sql))
            $sql = "DELETE FROM " . $this->nomeTabela . " WHERE " . $sql;
        $r = DB::query($sql);
        return $r;
    }

    public function replace($sql) {
        if (is_array($sql)) {
            $sql = DB_Select::getSelect('replace', $sql);
        }
        $r = DB::query($sql);
        if ($r == true)
            return mysql_insert_id();
        else
            return $r;
    }

}
