<?php

class DB_DDL extends DB {

    static $fields = array();
    static $tables = array();

    static function addField($tableName, $fieldName, $type = "VARCHAR(30)", $default = "") {
        $db = new DB();

        if (!DB_DDL::fieldExists($tableName, $fieldName)) {
            $default = !empty($default) ? " DEFAULT " . $default : "";
            $sql = "ALTER TABLE " . $tableName . " ADD " . $fieldName . " " . $type . " $default";
            $r = DB::execute($sql);
            if ($r) {
                DB_DDL::fetchFieldList($tableName);
            } else {
                echo "ERRO DDL addField cmd failed";
                exit;
            }

            return $r;
        }

        return true;
    }

    static function tableExists($tableName) {
        DB_DDL::fetchTableList();
        return isset(DB_DDL::$tables[$tableName]);
    }

    static function fieldExists($tableName, $fieldName) {
        DB_DDL::fetchFieldList($tableName);

        return isset(DB_DDL::$fields[$tableName][$fieldName]);
    }

    static function fetchFieldList($tableName) {
        if (isset(DB_DDL::$fields[$tableName]))
            return DB_DDL::$fields[$tableName];
        $db = new DB;
        $qr = $db->execute("SHOW COLUMNS FROM " . $tableName);

        if (mysql_num_rows($qr) == 0)
            return false;

        $fields = array();
        while ($row = mysql_fetch_object($qr)) {
            $fields[] = $row;
        }

        $fls = array();
        foreach ($fields as $f)
            $fls[$f->Field] = $f->Type;
        DB_DDL::$fields[$tableName] = $fls;

        return DB_DDL::$fields[$tableName];
    }

    static function fetchTableList() {
        if (count(DB_DDL::$tables) > 0)
            return DB_DDL::$tables;
        $db = new DB;
        $tables = $db->getRows("SHOW FULL TABLES", "mysql_fetch_array");
        $fls = array();
        if (is_array($tables))
            foreach ($tables as $f)
                foreach ($f as $k => $v)
                    if (!preg_match("/type/", $k))
                        $fls[$v] = $v;
        DB_DDL::$tables = $fls;


        return DB_DDL::$tables;
    }

}
