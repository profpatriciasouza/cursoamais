<?php

class Cad_Input_Formbreak extends Cad_Input {

    public function __construct($fieldName) {
        $this->Label = $fieldName;
        $this->showOnGrid = false;
        $this->changeOnInsert = false;
        $this->changeOnUpdate = false;
        parent::__construct('formbreak', $fieldName);
    }

}
