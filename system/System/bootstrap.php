<?php

class System_Bootstrap {

    static function findfile($urlMap, $position=0) {
        $mapa = System_Bootstrap::montaMapa($urlMap, $position);
        $proxPosicao = $position + 1;

        if (is_dir($mapa) && isset($urlMap[$proxPosicao]) && $urlMap[$proxPosicao] != "")
            return findfile($urlMap, ++$position);


        if (is_dir($mapa) && file_exists($mapa . "/index.php"))
            return $mapa . "/index.php";

        if (file_exists($mapa . ".php"))
            return $mapa . ".php";

        $mapa = System_Bootstrap::montaMapa($urlMap, --$position);

        if (is_dir($mapa) && file_exists($mapa . "/index.php"))
            return $mapa . "/index.php";

        if (file_exists($mapa . ".php"))
            return $mapa . ".php";

        header("HTTP/1.0 404 Not Found");
        include(dirname(__FILE__) . "/../../templates/include/404.php");
        exit;
    }

    static function montaMapa($urlMap, $position) {
        $dir = dirname(__FILE__) . "/../../templates";
        for ($i = 0; $i <= $position; $i++) {
            $dir.= "/" . $urlMap[$i];
        }

        return $dir;
    }

}

?>
