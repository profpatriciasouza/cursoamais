<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modal
 *
 * @author lucas
 */
class HTML_Modal extends HTML {

    public function build() {
        $this->childs = Hook::exec('html_pre_build', $this->childs);
        $this->getFile("html/modal/" . $this->tagName);
        Hook::exec('html_pos_build', $this);
    }

}
