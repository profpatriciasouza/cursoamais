<?php

class Template {

    public $ajuda;
    //Publico
    public $title;
    public $description;

    public function __construct() {

    }

    public function head() {
        $this->getFile("head.php");
    }

    public function getHeader($params = array()) {
        $this->getFile("header.php", $params);
    }

    public function getFooter($params = array()) {
        $this->getFile("footer.php", $params);

        Hook::exec('pos_get_footer', array($params));
    }

    public function setTitle($title = "") {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title == "" ? System_CONFIG::get('seo-tittle') : $this->title;
    }

    public function setDescription($description = "") {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getMenu($params = array()) {
        $this->getFile("menu.php", $params);
    }

    public function getSubMenu() {
        $this->getFile("/sub-menu.php");
    }

    public function getPathLink() {
        return "/" . Map::$area . "/" . Map::$modulo . "/" . Map::$acao . "/?m=" . $this->method . "&a=" . $this->action;
    }



    public function getBodyClass($class = "") {
        return "class='" . Map::$area . " " . Map::$modulo . " " . Map::$acao . " " . $class . "'";
    }

    public function isUrl($area, $modulo = "", $acao = "") {
        if (Map::$area == $area && (empty($modulo) || Map::$modulo == $modulo) && (empty($acao) || Map::$acao == $acao)) {
            return true;
        }
    }

    static function makeUrl($area, $modulo = "", $acao = "", $parametros = "") {
        return new Map_Url($area, $modulo, $acao, $parametros);
    }

    public function url($area, $modulo = "", $acao = "", $parametros = "") {
        return Template::makeUrl($area, $modulo, $acao, $parametros);
    }

    public function urlByAcao($acao, $id = "", $parametro = "id") {
        if ($this->parametro != "" && $parametro==="id") {
            $parametro = $this->parametro;
        }
        return $this->url(Map::$area, Map::$modulo, $acao, (empty($id) ? null : (is_array($id) ? $id : array($parametro => $id))));
    }

    static function urlParametros($params) {
        $MapUrl = new Map_Url();
        return $MapUrl->parametros($params);
    }

    public function getFile($file, $params = array()) {
        $base = Map::getPath();

        //Template file possible paths
        if (preg_match("/\.php/", $file)) {

            $paths[] = System_CONFIG::get('base') . $base . "/Templates/" . $file;
            $paths[] = System_CONFIG::get('base') . "/source/Templates/" . $file;
            $paths[] = System_CONFIG::get('base') . "/system/templates/" . $file;
        } else {
            $paths[] = System_CONFIG::get('base') . $base . "/Templates/" . $file . ".php";
            $paths[] = System_CONFIG::get('base') . "/source/Templates/" . $file . ".php";
            $paths[] = System_CONFIG::get('base') . "/system/templates/" . $file . ".php";
        }
        //Test possibilities
        foreach ($paths as $path) {
            if (file_exists($path)) {
                include($path);
                return;
            }
        }

        echo System_CONFIG::get('base') . "/system/templates/" . $file;
        echo System_CONFIG::get('base') . "/Templates/" . $file;

        Error::show("Não foi possível achar a VIEW " . $file, 1);
        return false;
    }

    static $assets;

    static function addFile($asset) {
        if (is_array($asset)) {
            foreach ($asset as $a)
                Template::$assets[md5($a)] = $a;
        } else {
            Template::$assets[md5($asset)] = $asset;
        }
    }

    public function addAsset($asset) {
        Template::addFile($asset);
    }

    public function loadAssets($type = "js") {
        if ($type == "js") {
            echo "<script>var map = { root: '" . Map::getRoot(true) . "', params: ".json_encode(Map::$parametros).', get: function(param) { return map.params[param]===undefined?"":map.params[param]; },getRoot: function() { return map.root; } };</script>';
        }

        if (is_array(Template::$assets)) {
            foreach (Template::$assets as $k => $asset) {
              var_dump($asset);
                if (end(explode(".", $asset)) == $type) {
                    unset(Template::$assets[$k]);
                    $this->loadAsset($asset, end(explode(".", $asset)));
                }
            }
        }

        if ($type == "js") {
            echo "<script>rootPath = '" . Map::getRoot() . "'</script>";
            $filePath = Map::getPath() . "/Assets/" . $type . "/" . Map::$modulo . "/" . Map::$acao . ".js";

            if (file_exists(System_CONFIG::get('base') . $filePath)) {
                $this->loadAsset(Map::getRoot() . $filePath, $type);
            }
        }
        if ($type == "css") {
            $filePath = Map::getPath() . "/Assets/" . $type . "/" . Map::$modulo . "/" . Map::$acao . ".css";
            if (file_exists(System_CONFIG::get('base') . $filePath)) {
                $this->loadAsset(Map::getRoot() . $filePath, $type);
            }
        }
    }

    public function loadAsset($file, $type = "js") {
        $file = str_replace("//", "/", $file);

        if ($type == "js") {
            echo '<script type="text/javascript" src="' . $file . '"></script>';
        }
        if ($type == "css") {
            echo '<link rel="stylesheet" rel="stylesheet" href="' . $file . '" />';
        }
    }

}
