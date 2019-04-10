<?php



function boot() {
    $configFile = dirname(__FILE__) . "/../config.php";
    if (file_exists($configFile))
        require($configFile);
    else
        Error::show("Não foi possível acessar o arquivo de configuração", 0);

    if (strpos($_SERVER['REQUEST_URI'], "?") > -1)
        $vetDados = explode("/", substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")));
    else
        $vetDados = explode("/", $_SERVER['REQUEST_URI']);

    if ($vetDados[0] == "")
        unset($vetDados[0]);

    //refaz o índice do array apartir da 0
    $vetDados = array_values($vetDados);

    //Carrega manifestos dos módulos
    Map::loadModules();
    
    session_start();

    //Joga dados para o mapeamento de URL
    Map::processa($vetDados);

    
    
    //Tenta achar o controller chamado na URL
    $controller = str_replace(" ", "", ucwords(strtolower(str_replace("-", " ", Map::$modulo))));
    $controller = "Controller_" . $controller;
    
       
    if (!class_exists($controller)) {
        Map::$modulo = "magico";
        $controller = "Controller_Magico";
    }

    //se ele achou o controller ele instância.
    $obj = new $controller($vetDados);
}

function __autoload($class_name) {  
    $pastas = explode("_", $class_name);
    $class = end($pastas);
    $last = count($pastas);
    unset($pastas[--$last]);

    $paths[] = dirname(__FILE__) . "/" . implode("/", $pastas) . "/" . $class . '/' . $class . '.php';


    //echo dirname(__FILE__) . "/" . implode("/", $pastas) . "/" . strtolower($class) . '.php<br />';
    if (isset($pastas[0]) && strtolower($pastas[0]) == "controller") {
        $path = Map::getPath();


        if ($class == "Magico") {
            $path = System_CONFIG::get('base') . $path . "/Controller/" . $class . '.php';
            if (file_exists($path))
                require $path;
            else {
                Error::show("Controller não encontrado", 0);
            }
            return;
        }



        $paths[] = System_CONFIG::get('base') . $path . "/Controller/" . $class . '.php';
        $paths[] = System_CONFIG::get('base') . $path . "/Controller/" . strtoupper($class) . '.php';
        
        foreach ($paths as $p) {
            if (file_exists($p)) {
                require $p;
                return;
            }
        }

        return false;
    } else if (isset($pastas[0]) && strtolower($pastas[0]) == "form") {
        $path = Map::getPath();

        $paths[] = System_CONFIG::get('base') . $path . "/" . implode("/", $pastas) . "/" . strtolower($class) . '.php';
        $paths[] = System_CONFIG::get('base') . $path . "/" . implode("/", $pastas) . "/" . $class . '.php';

        foreach ($paths as $path) {
            if (file_exists($path)) {
                require $path;
                return;
            }
        }

        Error::show("Form " . $class_name . " não encontrado", 0);

        return;
    } else if (isset($pastas[0]) && strtolower($pastas[0]) == "model")  { 
        $paths = DB_Model::getFolders();
        $paths[] = dirname(__FILE__) . "/../source/model/";
        
        
        foreach($paths as $path) {
            if(file_exists($path.$class.".php")) {
                require($path.$class.".php");
                return;
            }
        }
    }else {
        $paths[] = dirname(__FILE__) . "/../source/system/" . implode("/", $pastas) . "/" . ($class) . '.php';
        $paths[] = dirname(__FILE__) . "/../source/system/" . implode("/", $pastas) . "/" . strtolower($class) . '.php';
        $paths[] = dirname(__FILE__) . "/../source/system/" . implode("/", $pastas) . "/" . $class . '/' . $class . '.php';
        $paths[] = dirname(__FILE__) . "/../source/system/" . implode("/", $pastas) . "/" . $class . '/' . strtolower($class) . '.php';
        $paths[] = dirname(__FILE__) . "/../source/model/" . $class . '.php';
        $paths[] = dirname(__FILE__) . "/" . implode("/", $pastas) . "/" . ($class) . '.php';
        $paths[] = dirname(__FILE__) . "/" . implode("/", $pastas) . "/" . strtolower($class) . '.php';
        $paths[] = dirname(__FILE__) . "/" . implode("/", $pastas) . "/" . $class . '/' . $class . '.php';
        $paths[] = dirname(__FILE__) . "/" . implode("/", $pastas) . "/" . $class . '/' . strtolower($class) . '.php';

        foreach ($paths as $path)
            if (file_exists($path)) {
                include $path;
                return;
            }
    }
    
    throw new Exception("Classe ". $class_name." não existe".print_r($paths, 1), 1);
}