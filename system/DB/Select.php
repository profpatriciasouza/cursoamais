<?php

class DB_Select extends DB {

    public $select;
    public $from;
    public $where = "1=1";
    public $orderby = "";
    public $groupby = "";
    public $limit = "";
    public $limitePorPagina = 10;
    public $join = array();

    /*     * **************** ANTIGO ******************** */

    public function getRow($sql = "") {

        if (!empty($this->tableName)) {
            if (!empty($sql))
                $this->where = $sql;
            $sql = $this->getSelect();
        }

        $this->limit = "1";

        $qr = Ado::query($sql);
        if (mysql_num_rows($qr) == 0)
            return false;

        return mysql_fetch_object($qr);
    }

    public function getCount($sql = "") {

        if (!empty($this->tableName)) {
            $ado->where = $sql;
            $sql = $this->getSelect('count');
        }

        $this->limit = "1";

        $qr = Ado::query($sql);
        if (mysql_num_rows($qr) == 0)
            return false;

        return mysql_fetch_object($qr);
    }

    public function getAll($sql = "", $dataType = "mysql_fetch_object") {
        if (!empty($sql))
            $this->where($sql);

        $sql = $this->getSelect();

        return $this->getRows($sql, $dataType);
    }

    public function joinLeft($table, $condition, $fields) {
        $this->join($table, $condition, $fields, "LEFT JOIN");
    }

    public function joinRight($table, $condition, $fields) {
        $this->join($table, $condition, $fields, "RIGHT JOIN");
    }

    public function join($table, $condition, $fields, $joinType = "INNER JOIN") {
        $this->join[] = array('table' => $table, 'condition' => $condition, 'fields' => $fields, 'joinType' => $joinType);
    }

    public function where($where) {
        $this->where.= " AND " . $where;
    }

    public function orWhere($where) {
        $this->where.= " AND (" . $where . ")";
    }

    /*
     * TODO
     * Dividir esta função em outras funções
     */

    public function getSelect($type = "SELECT", $vetFields = array()) {
        switch (strtolower($type)) {
            case 'selectcount':
            case 'select':

                $select = empty($this->select) ? "*" : $this->select;
                $from = $this->from;
                foreach ($this->join as $join) {
                    if (!is_array($join['fields'])) {
                        $join['fields'] = array($join['fields']);
                    }
                    if ($type != 'selectcount')
                        foreach ($join['fields'] as $field) {
                            $select.=", " . $join['table'] . "." . $field;
                        }

                    $from.= " " . $join['joinType'] . " " . $join['table'] . " ON " . $join['condition'];
                }

                $where = $this->where;
                $sql = "SELECT " . $select . " FROM " . $from . " WHERE " . $where;

                if ($this->groupby != "") {
                    $sql.=" GROUP BY " . $this->groupby;
                }
                if ($this->orderby != "") {
                    $sql.=" ORDER BY " . $this->orderby;
                }

                if ($this->limit != "") {
                    $sql.=" LIMIT " . $this->limit;
                }

                break;
            case 'count':
                $select = $this->select;
                $limit = $this->limit;
                $this->limit = "";
                $this->select = "count(1) as num";
                $sql = $this->getSelect('selectcount');

                $this->limit = $limit;
                return $sql;
                break;
            case 'insert':
                $sql = "INSERT INTO " . $this->tableName . " ({fields}) VALUES ({values})";

                $fields = "";
                $values = "";
                foreach ($vetFields as $k => $v) {
                    $fields.= empty($fields) ? $k : "," . $k;
                    $values.= empty($values) ? "'" . $v . "'" : ", '" . $v . "'";
                }
                $sql = str_replace("{fields}", $fields, $sql);
                $sql = str_replace("{values}", $values, $sql);

                break;
            case 'replace':
                $sql = "REPLACE INTO " . $this->tableName . " ({fields}) VALUES ({values})";

                $fields = "";
                $values = "";
                foreach ($vetFields as $k => $v) {
                    $fields.= empty($fields) ? $k : "," . $k;
                    $values.= empty($values) ? "'" . $v . "'" : ", '" . $v . "'";
                }
                $sql = str_replace("{fields}", $fields, $sql);
                $sql = str_replace("{values}", $values, $sql);

                break;
            case 'update':
                $sql = "UPDATE " . $this->tableName . " SET";

                $fields = "";
                foreach ($vetFields as $k => $v) {
                    $fields.= empty($fields) ? " " . $k . " = '" . $v . "'" : "," . $k . " = '" . $v . "'";
                }

                $sql.=$fields;

                break;
            default:
                break;
        }


        return $sql;
    }

}
