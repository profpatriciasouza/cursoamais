<?php

/**
 * Description of HTML_Form
 *
 * @author schirm
 */
class HTML_Form extends HTML {

    public $tagName = "form";
    public $action = "";
    public $method = "GET";
    //HOOKS
    public $salva;

    public function __construct($id = "", $action, $method = "GET") {
        parent::__construct($id);

        $this->action = $action;
        $this->method = $method;
    }

    public function addInput(HTML_Input $input) {
        $input->id = $this->id . "_" . $input->id;
        parent::add($input);
    }

    public function findFieldByName($fieldName) {
        foreach ($this->childs as $field)
            if ($field->name === $fieldName)
                return $field;

        return false;
    }

    public function createInput($type, $name, $label) {
        $this->addInput(new HTML_Input($type, $name, $label));
    }

    public function getPostDataChild($childs, $vet = array()) {
        
        foreach ($childs as $child) {
            /*
             * Tem que jogar isso para a HTML_Input, para que cada objeto lide da forma que lhe convir
             * modelo:
             * 
             * $vet = $child->getPost($vet);
             * 
             * Desta forma, se tiver dois campos, como em Autocomplete, ele já retorna com tudo pronto e tratado.
             */

            if (get_class($child) == "HTML_Input" || get_parent_class($child) == "HTML_Input") {
                $vet = $child->getPostValue($vet);
            } else if (is_array($child->childs) && (!empty($child->childs))) {
                $vet = $this->getPostDataChild($child->childs, $vet);
            }
        }
        
        return $vet;
    }

    public function getPostData() {
        return $this->getPostDataChild($this->childs);
    }

    public function getPostDataOLD() {
        foreach ($this->childs as $child) {
            /*
             * Tem que jogar isso para a HTML_Input, para que cada objeto lide da forma que lhe convir
             * modelo:
             * 
             * $vet = $child->getPost($vet);
             * 
             * Desta forma, se tiver dois campos, como em Autocomplete, ele já retorna com tudo pronto e tratado.
             */
            if (get_class($child) == "HTML_Input_Autocomplete") {
                $vet["ID_" . $child->name] = HTTP::getPost("ID_" . $child->name);
                $vet[$child->name] = HTTP::getPost($child->name);
            } else
            if (get_class($child) == "HTML_Input" || get_parent_class($child) == "HTML_Input") {
                $vet[$child->name] = HTTP::getPost($child->name);
            } else {
                $vet[$child->name] = HTTP::getPost($child->name);
            }
        }
        return $vet;
    }

    public function salva($hook = "") {
        if (!empty($hook)) {
            $this->hook = $hook;
        } else {
            $ret = call_user_func_array($this->hook, array($this));
            JSON::trataRetorno();
            return $ret;
        }
    }

}
