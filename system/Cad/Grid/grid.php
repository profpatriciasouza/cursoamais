<?php

class Cad_Grid {

    static $randomBGtf = true;

    static function getRandomBG() {
        if (Cad_Grid::$randomBGtf) {
            Cad_Grid::$randomBGtf = false;
            return "colored";
        }
        
        Cad_Grid::$randomBGtf = true;
        return "";
    }

}
