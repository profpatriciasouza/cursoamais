<?php

/**
 * Description of JSON
 *
 * @author lucas
 */
class JSON {
    /*
     * TODO 
     * Tratar em caso de erro no JSON
     */

    static function decode($json) {
        return json_decode($json);
    }

    static function encode($json) {
        return json_encode($json);
    }

    static function trataRetorno() {
        if (Error::hasErrors()) {
            $mensagem = Error::getLastError();
            if (is_array($mensagem)) {
                echo JSON::retorno(3, Error::getMsg($mensagem[0]), array("campo" => Error::getMapaCammpos($mensagem[1])));
            }
            else
                echo JSON::retorno(0, Error::getMsg($mensagem));
        } else {
            echo JSON::retorno(1, Error::getMensagemSucesso());
        }
        exit;
    }

    static function retorno($status, $mensagem, $parametros = array()) {
        $parametros['status'] = $status;
        $parametros['message'] = $mensagem;

        return JSON::encode($parametros);
    }

    static function retornoURL($url) {
        return JSON::retorno(3, null, array('url' => $url));
    }

}
