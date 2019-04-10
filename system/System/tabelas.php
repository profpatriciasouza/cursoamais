<?php
class System_Tabelas {
    static function getNomeTabela($nome) {
        return System_CONFIG::$_prefix.$nome;
    }
    static function getCampoTabela($nome, $campo) {
        return System_CONFIG::$_prefix.$nome.".".$campo;
    }
}
?>
