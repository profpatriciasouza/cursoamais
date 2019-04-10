<?php

class Plugins_SEO {

    public function getTitle() {
        if (!System_CONFIG::$PluginSEO) {
            return System_CONFIG::$DefaultTitle;
        }
    }

    public function getDescription() {
        if (!System_CONFIG::$PluginSEO) {
            return "";
        }
    }

    public function getKeywords() {
        if (!System_CONFIG::$PluginSEO) {
            return "";
        }
    }

    static function urlAmigavel($str) {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_| -]+/", '-', $clean);

        return $clean;
    }

}
