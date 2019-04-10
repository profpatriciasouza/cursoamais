<?php

class DB extends DB_Query {

    //conexão aberta
    static $c = null;
    /*
     * Campso básicos para o model
     */
    public $chavePrimaria = "";

    public function __construct($nomeTabela = "") {
        parent::__construct($nomeTabela);

        DB::getConnection();
    }

    static function getConnection() {
        if (DB::$c === null) {
            DB::startConnection();
        }
        return DB::$c;
    }

    static function startConnection() {
        $dbs = System_CONFIG::get('db');
        foreach ($dbs as $host => $dbConfig)
            if (HTTP::comparaHost($host)) {
                $db = $dbConfig;
                break;
            }

        if (!isset($db))
            if (!isset($dbs['default']))
                Error::show("Acesso ao BD não configurado corretamente", 0);
            else
                $db = $dbs['default'];

        DB::$c = @mysql_connect($db['host'], $db['user'], $db['pass']) or Error::show(mysql_error(), 0);
        mysql_select_db($db['db']) or Error::show(mysql_error(), 0);
    }

    static function prepare($query, $phs = array()) {
        $phs = array_map(create_function('$ph', 'return addslashes(mysql_real_escape_string($ph));'), $phs);

        $curpos = 0;
        $curph = count($phs) - 1;

        for ($i = strlen($query) - 1; $i > 0; $i--) {

            if ($query[$i] !== '?')
                continue;
            if ($curph < 0 || !isset($phs[$curph]))
                $query = substr_replace($query, 'NULL', $i, 1);
            else
                $query = substr_replace($query, $phs[$curph], $i, 1);

            $curph--;
        }
        unset($curpos, $curph, $phs);
        return $query;
    }

    static function query($sql) {
        DB::getConnection();

        $qr = mysql_query($sql) or Error::show($sql . " - " . mysql_error());
        System_Log::query("Qr:" . $qr . " Sql: " . $sql);
        return $qr;
    }

    static function execute($sql) {
        return DB::query($sql);
    }

    public function getRow($sql, $mysql_fetch = "mysql_fetch_object") {
        $qr = DB::query($sql);
        if (mysql_num_rows($qr) == 0)
            return false;

        if ($mysql_fetch == "model") {
            $row = mysql_fetch_array($qr, MYSQL_ASSOC);
            $className = get_class($this);
            return $this->getModel($className, $row);
        }
        return $mysql_fetch($qr);
    }

    public function getRows($sql, $mysql_fetch = "mysql_fetch_object") {
        $qr = DB::query($sql);

        if (mysql_num_rows($qr) == 0)
            return false;

        if ($mysql_fetch == "model") {
            $rows = array();
            while ($row = mysql_fetch_array($qr, MYSQL_ASSOC)) {
                $className = get_class($this);
                $rows[] = $this->getModel($className, $row);
            }
            return $rows;
        }

        $rows = array();
        while ($row = $mysql_fetch($qr)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getModel($className, $row = array()) {
        $obj = new $className;
        foreach ($row as $k => $v) {
            $obj->$k = $v;
        }
        return $obj;
    }

    /* Transações */

    static function startTrans() {
        DB::query("START TRANSACTION");
    }

    static function rollback() {
        DB::query("ROLLBACK");
    }

    static function commit() {
        DB::query("COMMIT");
    }

}
