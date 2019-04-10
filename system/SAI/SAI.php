<?php

/**
 * Classe de integração com o SAI
 *
 * @author lucas
 */
class SAI {

    //id do produto
    static $idProduto = "";
    //configuração completa
    static $config = false;
    //Endereço de conexão
    static $address;

    static function carregaConfiguracoes() {
        if (!SAI::$config) {
            SAI::$config = System_CONFIG::get("SAI");
            SAI::$idProduto = SAI::$config['idProduto'];
            $address = SAI::$config['address'];
            foreach ($address as $host => $address) {
                if (HTTP::comparaHost($host)) {
                    SAI::$address = $address;
                }
            }
        }
    }

    static function enviaPost($url, $campos) {
        SAI::carregaConfiguracoes();
        $snp = new HTTP_Snoopy;

        $campos['proid'] = SAI::$idProduto;

        System_Log::logit("Envia post: ", SAI::$address.$url. " Campos: ".print_r($campos, true));

        if ($snp->submit(SAI::$address . $url, $campos)) {
            System_Log::logit("Retorno post: ", $snp->results);
            return $snp->results;
        } else {
            return false;
        }
    }

    static function erro($cod) {
        if ($cod == "SAI0001") {
            Error::add("Falha ao registrar usuário SAI HTTP ERROR");
            if (HTTP::isAjax()) {
                echo json_encode(
                        array(
                            "status" => 0
                            , "message" => "Falha ao registrar usuário, tente novamente em 30 minutos"
                        )
                );
                exit;
            } else {
                HTTP::redirect("/falha-no-sistema");
            }
        }
    }

}
