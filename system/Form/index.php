<?php

class Form {

    static function getPost($dataType, $fieldName) {
        switch ($dataType) {
            case 'datetime':
                return Ado::getDataTimeFormat($_POST[$fieldName] . " " . $_POST[$fieldName . "Hora"]);
                break;
            case 'multifile':
                return isset($_POST[$fieldName]) ? json_encode($_POST[$fieldName]) : "";
                break;
            default:
                return!isset($_POST[$fieldName]) ? $this->value : $_POST[$fieldName];
                break;
        }
    }

}

?>
