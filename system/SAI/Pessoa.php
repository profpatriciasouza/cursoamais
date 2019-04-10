<?php

/**
 * Integra com a parte de pessoas do SAI
 * 
 * @author lucas
 */
class SAI_Pessoa extends SAI {
    
    /* Campos e métodos do objeto pessoa*/
    
    public $pesNome = "";
    public $pesEmail = "";
    public $pesSenha = "";
    public $pesDtNascimento = "";
    
    
    /* Singleton de itengração com a API */
    static $urlCadastro = "/pessoa/cadastro";
    static $urlAutenticacao = "/pessoa/autenticacao";
    static $urlGetByEmail = "/pessoa/get-by-email";

    static function cadastro(SAI_Pessoa $SAIPessoa) {
        $vet['pesnome'] = $SAIPessoa->pesNome;
        $vet['pesemail'] = $SAIPessoa->pesEmail;
        $vet['pessenha'] = $SAIPessoa->pesSenha;
        $vet['pesnascimento'] = $SAIPessoa->pesDtNascimento;
        
        return SAI::enviaPost(SAI_Pessoa::$urlCadastro, $vet);
    }

    static function autentica(SAI_Pessoa $SAIPessoa) {
        $vet['pesemail'] = $SAIPessoa->pesEmail;
        $vet['pessenha'] = $SAIPessoa->pesSenha;
        
        return SAI::enviaPost(SAI_Pessoa::$urlAutenticacao, $vet);
    }
    static function getByEmail($Email) {
        $vet['pesemail'] = $Email;
        
        return SAI::enviaPost(SAI_Pessoa::$urlGetByEmail, $vet);
    }
    
    
    /*
     * Verifica através da API se usuário tem senha cadastrada.
     * Garantindo que senha não seja substituida em outros sistemas
     */
    static function temSenha($saiId) {
        $retorno = json_decode(SAI::enviaPost("/pessoa/tem-senha", array("saiid" => $saiId)));
        if(!$retorno) {
            return false;
        }
        return $retorno->temSenha == 1;
    }
    
    static function alteraSenha($saiId, $novaSenha) {
        $param = array("saiid" => $saiId, 'pessenha' => $novaSenha);
        $retorno = json_decode(SAI::enviaPost("/pessoa/altera-senha", $param));
        
        
        if(!$retorno)
            return false;
        return $retorno->status == 1;
    }
}