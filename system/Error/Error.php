<?php

class Error extends Template {
    /*
     * Level
     *  0 = Falha estrutural nos sistemas básicos
     *  1 = Falha de sistema, pausa completa
     *  2 =
     *  3 =
     *  4 =
     *  5 =
     *  6 =
     *  7 = Erro de usuário.
     */
    /*
     * ERRO CADASTRADO
     */

    public $cod;
    public $message;
    public $level = 7;

    public function __construct($cod, $message, $level = 7) {
        $this->cod = $cod;
        $this->message = $message;
        $this->level = $level;
    }

    public function getMessage() {
        return $this->message;
    }

    /*
     * Métodos de acesso
     */

    static $erros = array();
    static $msgs = array();
    static $mapaCampos = array();



    /*
     * Parametros para formulário
     */
    static $mensagemSucesso;

    static function getMensagemSucesso() {
        return Error::$mensagemSucesso;
    }

    static function setMensagemSucesso($mensagem = "") {
        Error::$mensagemSucesso = $mensagem;
    }

    static function addMapaCammpos($campo, $name) {
        Error::$mapaCampos[$campo] = $name;
    }

    static function getMapaCammpos($campo) {
        return Error::$mapaCampos[$campo];
    }

    static function add($cod, $campo = "") {
        $_SESSION['erros'][$cod] = empty($campo) ? $cod : array($cod, $campo);
    }

    static function get($cod) {
        return $_SESSION['erros'][$cod];
    }

    static function showAlerts() {
        if (!Error::hasErrors())
            return;

        foreach ($_SESSION['erros'] as $msg) {
            $HTMLAlert = new HTML_Alert(Error::getMsg($msg));
            $HTMLAlert->class = "alert-danger";
            $HTMLAlert->build();
        }

        Error::clearError();
    }

    static function clearError() {
        $_SESSION['erros'] = null;
        unset($_SESSION['erros']);
    }

    static function getLastError() {
        // faz parte da função hasErrors, mas simplifica a programação para não ter que usar as duas
        if (isset($_SESSION['erros']))
            return end ($_SESSION['erros']);
        else
            return false;
    }

    static function getLastMessage($padrao = "") {
        $error = Error::hasErrors() ? Error::getMsg(Error::getLastError()) : $padrao;
        Error::clearError();
        return $error;
    }

    static function hasErrors() {
        return isset($_SESSION['erros']) && count($_SESSION['erros']) > 0;
    }

    static function show($msg, $level = 5) {

        if ($level === 0) {
            echo "Estamos temporariamente fora do ar, tente acessar novamente dentro de 30 segundos";
        }
        echo "<h1>" . utf8_decode($msg) . "</h1>";
        exit;
    }

    static function report($titulo, $mensagem) {
        // mail("lucas@ogenial.com.br", $titulo, $mensagem);
    }

    static function msg($msg) {

    }

    static function addMsg($cod, $message, $level = 7) {
        Error::$erros[$cod] = new Error($cod, $message, $level);
    }

    static function getMsg($cod) {
        return is_array($cod) ? Error::$erros[$cod[0]]->getMEssage : isset(Error::$erros[$cod]) ? Error::$erros[$cod]->getMessage() : $cod." - Falha geral no sistema";
    }

}
