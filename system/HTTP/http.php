<?php

class HTTP {
    static function redirect($local, $type=301) {
        header('HTTP/1.1 301 Moved Permanently');
        header("location: ".$local);
        exit;
    }
    
    static function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    static function isPost($idx="") {  return empty($idx) && $_POST ? true : (isset($_POST[$idx]) ? true : false); }
    //static function getPost($idx) { return isset($_POST[$idx]) ? filter_input(INPUT_POST, $idx) : ""; }
    static function getPost($idx) { return isset($_POST[$idx]) ? (is_array($_POST[$idx]) ? $_POST[$idx] : filter_input(INPUT_POST, $idx)) : ""; }
    
    static function get($id)  { return isset($_GET[$id]) ? $_GET[$id] : ""; }
    
    static function comparaHost($host) { return preg_match("/$host/", $_SERVER['SERVER_NAME']); }
}