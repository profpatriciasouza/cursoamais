<?php

class Security {

    public $nameSpace;

    public function __construct($nameSpace) {
        $this->nameSpace = $nameSpace;
    }

    public function __set($name, $value) {
        $_SESSION[$this->nameSpace][$name] = $value;
    }

    public function __get($name) {
        if (isset($_SESSION[$this->nameSpace]) && isset($_SESSION[$this->nameSpace][$name]))
            return $_SESSION[$this->nameSpace][$name];
    }

    public function has($name) {
        return $this->exists($name);
    }

    public function exists($name) {
        return isset($_SESSION[$this->nameSpace][$name]);
    }

    public function nameSpaceExists() {
        return isset($_SESSION[$this->nameSpace]);
    }

    public function deleteNameSpace() {
        $_SESSION[$this->nameSpace] = null;
        unset($_SESSION[$this->nameSpace]);
    }

    static function hasAccess() {
        return isset($_SESSION[Map::getSessionNameSpace()]) && isset($_SESSION[Map::getSessionNameSpace()]['user']);
    }

    static function getID() {
        return $_SESSION[Map::getSessionNameSpace()]['user']->CodigoUsuario;
    }

    static function registerUser($user) {
        $_SESSION[Map::getSessionNameSpace()]['user'] = serialize($user);
    }

    static function get($data) {
      if (!is_object($_SESSION[Map::getSessionNameSpace()]['user'])) {
        $user_name = unserialize($_SESSION[Map::getSessionNameSpace()]['user']);
        return isset($user_name) ? $user_name->$data : "";
      } else {
        return isset($_SESSION[Map::getSessionNameSpace()]['user']) ? $_SESSION[Map::getSessionNameSpace()]['user']->$data : "";
      }
    }

    static function revokeAccess() {
        unset($_SESSION[Map::getSessionNameSpace()]['user']);
        $_SESSION[Map::getSessionNameSpace()] = null;
    }

}
