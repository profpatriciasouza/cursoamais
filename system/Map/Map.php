<?php

class Map {

    static $folder;
    static $area;
    static $modulo;
    static $acao;
    static $parametros;
    static $folderInRoot;

    static public function setup($area, $modulo, $acao) {
        Map::$area = $area;
        Map::$modulo = $modulo;
        Map::$acao = $acao;
    }

    static function alias($area, $modulo, $acao) {
        return array(
            'area' => $area,
            'modulo' => $modulo,
            'acao' => $acao,
        );
    }

    static public function getAll() {
        return Map::$parametros;
    }

    static public function getAllWithout($param = array()) {
        $parametros = Map::getAll();

        foreach ($param as $k) {
            unset($parametros[$k]);
        }
        return $parametros;
    }

    static function getRoot($isUrl=false) {
        $isUrl = $isUrl || self::$folderInRoot;
        
        return (!$isUrl ? "/" : count(self::$folder) === 0 ? "/" : "/" . implode("/", self::$folder) . "/");
    }

    static public function getAllWith($param = array()) {
        $parametros = Map::getAll();

        foreach ($param as $k => $v) {
            $parametros[$k] = $v;
        }
        return $parametros;
    }

    static public function get($i) {
        return Map::exists($i) ? urldecode(Map::$parametros[$i]) : "";
    }
    static public function has($i) {
        return self::exists($i);
    }
    static public function exists($i) {
        return isset(Map::$parametros[$i]);
    }

    static public function addParam($i, $v) {
        Map::$parametros[$i] = $v;
    }

    static public function getSessionNameSpace() {
        $nameSpace = System_CONFIG::get('map');
        $nameSpace = isset($nameSpace[Map::$area]['nameSpace']) ? $nameSpace[Map::$area]['nameSpace'] : "";
        return empty($nameSpace) ? Map::$area : $nameSpace;
    }

    static public function getPath() {
        $map = System_CONFIG::get('map');
        if (!isset($map[Map::$area]['path'])) {
            Error::msg("Não foi possível encotnrar o parâmetro 'path' para a área " . Map::$area, 0);
        }
        if (!is_dir(System_CONFIG::get('base') . $map[Map::$area]['path'])) {
            Error::msg("Diretório '" . System_CONFIG::get('base') . $map[Map::$area]['path'] . "' não existe ", 0);
        }

        return $map[Map::$area]['path'];
    }

    static public function processa($vetDados) {
        $map = System_CONFIG::get('map');

        if (isset($map['folder-in-root'])) {
            self::$folderInRoot = $map['folder-in-root'];
        }

        $folder = isset($map['folder']) ? $map['folder'] : "";

        self::$folder = $folder;

        if (!is_array(self::$folder))
            self::$folder = array(self::$folder);

        foreach (self::$folder as $k => $folder) {
            $i = array_search($folder, $vetDados);

            if ($i !== false) {
                unset($vetDados[$i]);
                $vetDados = array_values($vetDados);
            }
        }

        if (!isset($map['default'])) {
            Error::show("Não foi configurada uma área padrão", 0);
        }

        /* SE MAPA ESTIVER CONFIGURADO COMPLETO */
        if (isset($vetDados[0]) && isset($map[$vetDados[0]])) {

            if (isset($vetDados[1]) && isset($map[$vetDados[0]]['alias'][$vetDados[1]])) {
                $area = $map[$vetDados[0]]['alias'][$vetDados[1]]['area'];
                $modulo = $map[$vetDados[0]]['alias'][$vetDados[1]]['modulo'];
                $acao = $map[$vetDados[0]]['alias'][$vetDados[1]]['acao'];
                unset($vetDados[0]);
                unset($vetDados[1]);
            } else {
                //Se for de alguma área que não default
                if (isset($map[$vetDados[0]]) && is_array($map[$vetDados[0]])) {
                    $area = $vetDados[0];
                    $modulo = isset($vetDados[1]) && !empty($vetDados[1]) ? $vetDados[1] : "index";
                    $acao = isset($vetDados[2]) ? $vetDados[2] : "index";
                    unset($vetDados[0]);
                    unset($vetDados[1]);
                    unset($vetDados[2]);
                } else {
                    $area = $map[$vetDados[0]];
                    if (isset($map[$area]['alias'][$vetDados[1]])) {
                        $area = $map[$area]['alias'][$vetDados[1]]['area'];
                        $modulo = $map[$area]['alias'][$vetDados[1]]['modulo'];
                        $acao = $map[$area]['alias'][$vetDados[1]]['acao'];
                    } else {
                        $modulo = isset($vetDados[1]) && !empty($vetDados[1]) ? $vetDados[1] : "index";
                        $acao = isset($vetDados[2]) && !empty($vetDados[2]) ? $vetDados[2] : "index";
                    }
                    unset($vetDados[0]);
                    unset($vetDados[1]);
                    unset($vetDados[2]);
                }
            }
        } else {
            $area = $map['default'];
            if (isset($vetDados[0]) && isset($map[$area]['alias'][$vetDados[0]])) {
                extract($map[$area]['alias'][$vetDados[0]]);
            } else {
                $modulo = isset($vetDados[0]) && !empty($vetDados[0]) ? $vetDados[0] : "index";
                $acao = isset($vetDados[1]) && !empty($vetDados[1]) ? $vetDados[1] : "index";
            }
        }

        $acao = empty($acao) ? "index" : $acao;

        Map::addParam("area", $area);
        Map::addParam("modulo", $modulo);
        Map::addParam("acao", $acao);
        Map::setup($area, $modulo, $acao);

        $vetDados = array_values($vetDados);
        for ($i = 0; $i < count($vetDados); $i++) {
            $b = $i + 1;
            Map::addParam($vetDados[$i], isset($vetDados[$b]) ? $vetDados[$b] : $vetDados[$i]);
            $i++;
        }
    }

    static public function buildLink($modulo, $acao = "", $area = "", $parameters = array()) {
        if (!empty($area) && $area != "default")
            $link = (self::$folder != "" ? "/" . self::$folder : "") . "/" . $area . "/" . $modulo . "/" . $acao . "/";
        else if (!empty($acao))
            $link = (self::$folder != "" ? "/" . self::$folder : "") . $modulo . "/" . $acao . "/";
        else
            $link = (self::$folder != "" ? "/" . self::$folder : "") . "/" . $modulo . "/index/";


        foreach ($parameters as $k => $v) {
            if (empty($k) && empty($v))
                continue;
            $link.=$k . "/" . $v . "/";
        }

        return $link;
    }

    static public function loadModules() {
//Lista pastas dos módulos excluindo os diretórios anteriores . e ..
        $modulos = array_diff(scandir(System_CONFIG::get('base') . "/source/", 1), array('.', '..'));
//inclui os módulos que possuem manfesto

        foreach ((array) $modulos as $modulo)
            if (file_exists(System_CONFIG::get('base') . "/source/" . $modulo . "/" . $modulo . ".php"))
                include(System_CONFIG::get('base') . "/source/" . $modulo . "/" . $modulo . ".php");
    }

}
