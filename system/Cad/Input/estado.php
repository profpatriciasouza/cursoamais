<?php

class Cad_Input_Estado extends Cad_Input {

    public function __construct($fieldName) {
        $this->addOption('', 'Selecione');
        $this->addOption('AC', 'Acre');
        $this->addOption('AL', 'Alagoas');
        $this->addOption('AM', 'Amazonas');
        $this->addOption('AP', 'Amapá');
        $this->addOption('BA', 'Bahia');
        $this->addOption('CE', 'Ceara');
        $this->addOption('DF', 'Distrito Federal');
        $this->addOption('ES', 'Espírito Santo');
        $this->addOption('GO', 'Goias');
        $this->addOption('MA', 'Maranhão');
        $this->addOption('MG', 'Minas Gerais');
        $this->addOption('MS', 'Mato Grosso do Sul');
        $this->addOption('MT', 'Mato Grosso');
        $this->addOption('PA', 'Pará');
        $this->addOption('PB', 'Paraíba');
        $this->addOption('PE', 'Pernambuco');
        $this->addOption('PI', 'Piauí');
        $this->addOption('PR', 'Parana');
        $this->addOption('RJ', 'Rio de Janeiro');
        $this->addOption('RN', 'Rio Grande do Norte');
        $this->addOption('RO', 'Rondônia');
        $this->addOption('RR', 'Roraima');
        $this->addOption('RS', 'Rio Grande do Sul');
        $this->addOption('SC', 'Santa Catarina');
        $this->addOption('SE', 'Sergipe');
        $this->addOption('SP', 'São Paulo');
        $this->addOption('TO', 'Tocantins');



        parent::__construct("select", $fieldName);
    }

}
