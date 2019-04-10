<?php
class System {

    static $modulo;
    static $acao;
    static $acessos;

    static function getMenu($menu, $modulo = "", $acao = "", $cadastro = "") {

        if (!is_object(System::$acessos)) {
            System::$acessos = new System_Acessos();
        }
        $acesso = System::$acessos->checa($menu, $modulo, $acao, $cadastro);
        System_Log::logit("Gera menu $menu, $modulo, $acao, $cadastro", print_r($acesso, 1));
        
        return $acesso;
    }

    static function getLink($modulo, $acao="", $cadastro = "") {
        if (!empty($cadastro)) {
            return "/".Map::$area."/" . $modulo . "/" . $acao . "/acao-cadastro/" . $cadastro;
        }
        if (!empty($acao)) {
            return "/".Map::$area. "/" . $modulo . "/" . $acao;
        }
        if (!empty($modulo)) {
            return "/".Map::$area. "/" . $modulo;
        }

        return System_CONFIG::getURL();
    }

    static function getActive($modulo, $acao) {
        $acao = empty($acao) ? "index" : $acao;
        if ($acao == "index")
            if ($modulo == strtolower(System::$modulo)) {
                System_Log::logit("Checa menu ativo:", "Active: $modulo - $acao");
                return "active";
            }

        if ($modulo == strtolower(System::$modulo) && strtolower(System::$acao) == $acao) {
            System_Log::logit("Checa menu ativo:", "Active: $modulo - $acao");
            return "active";
        }
        System_Log::logit("Checa menu ativo:", strtolower(System::$modulo) . ":$modulo - " . System::$acao . ":$acao");
    }
}
