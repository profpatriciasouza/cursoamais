<?php

class Modules extends Template {

    //static $modules single ton handle
    static $modules;
    public $module;
    public $moduleName;
    public $requiredModules;
    public $subMenu = array();

    //set constructor
    public function __construct($module, $moduleName, $path = "") {
        $this->module = $module;
        $this->moduleName = $moduleName;
        $this->modulePath = $path;
    }

    /* Module OBJ Functions */

    //register a required module to run this module
    public function requireModules($moduleRequire) {
        if (is_array($moduleRequire))
            foreach ($moduleRequire as $module)
                Modules::$modules[$this->module]->requiredModules[] = $module;
        else
            Modules::$modules[$this->module]->requiredModules[] = $moduleRequire;
    }

    public function addSubMenu($subMenu) {
        $this->subMenu = $subMenu;
    }

    public function getSubMenu() {
        return $this->subMenu;
    }

    static function menu($nome, $link) {
        return array("ancora" => $nome, "link" => $link);
    }

    /* STATIC FUNCTIONS */

    //register module
    static function register($module, $moduleName, $path = "") {
        if (isset(Modules::$modules[$module])) {
            Error::msg("Falha: Módulo " . $module . " duplicado", 0);
        }
        //register module
        Modules::$modules[$module] = new Modules($module, $moduleName, $path);
    }

    //check if module is registered
    static function exists($module) {
        return isset(Modules::$modules[$module]);
    }

    //get module

    static function get($module) {
        if (!isset(Modules::$modules[$module])) {
            Error::msg("Falha: Módulo " . $module . " não existe", 0);
        }

        $module = Modules::$modules[$module];
        if (is_object($module) && get_class($module)!='Modules') {
            return $module;
        } else {
            require($module->modulePath);

            $moduleClass = "Modules_" . $module->module;

            $module = new $moduleClass($module->module, $module->moduleName, $module->modulePath);

            Modules::$modules[$module->module] = $module;
            return $module;
        }
    }

}
