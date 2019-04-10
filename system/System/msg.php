<?php
class System_MSG {
    static $msgs = array();
    static function add($tag, $msg) {
        System_MSG::$msgs[$tag] = $msg;
    }
    
    static function get($tag)  {
        return isset(System_MSG::$msgs[$tag]) ? System_MSG::$msgs[$tag] : "Mensagem de erro padrão: Não foi possível localizar mensagem de erro ".$tag;
    }
    
    static function ajax($status = 1, $msg) {
        echo json_encode(array('status' => $status, 'msg' => $msg));
        exit;
    }
}
?>