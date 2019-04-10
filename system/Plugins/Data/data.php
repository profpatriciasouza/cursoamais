<?php

class Plugins_Data {
    /*
     * Retorna data atual no formato do banco
     * 
     * por Lucas Schirm
     */

    static function getDataCadastro() {
        return date("Y-m-d H:i:s");
    }

    static function datetimeToDB($data, $hora = "") {
        $v = explode("/", $data);
        if (count($v) != 3)
            return "";

        list($d, $m, $y) = $v;
        if (!empty($hora)) {
            $v = explode(":", $hora);
            if (count($v) == 2)
                list($h, $i) = $v;
            return $y . "-" . $m . "-" . $d . " " . $h . ":" . $i;
        }
        return $y . "-" . $m . "-" . $d;
    }

    static function dbDatetimeToBR($data) {
        list($data, $hora) = explode(" ", $data);
        list( $ano, $mes, $dia) = explode("-", $data);
        return $dia . "/" . $mes . "/" . $ano . " " . $hora;
    }

    static function dbDateToBR($data) {
        if (empty($data))
            return false;

        list( $ano, $mes, $dia) = explode("-", $data);
        return $dia . "/" . $mes . "/" . $ano;
    }

    static function timeToDB($hora) {
        if (preg_match("/:/", $hora)) {
            list($h, $i) = explode(":", $hora);

            return $h . ":" . $i;
        }
        return null;
    }

    static function getDayOfWeek($data) {
        @list($dia, $mes, $ano) = explode("/", $data);
        $t1 = @mktime(0, 0, 0, $mes, $dia, $ano);


        switch (strtolower(date("D", $t1))) {
            case 'mon': return "segunda-feira";
                break;
            case 'tue': return "terça-feira";
                break;
            case 'wed': return "quarta-feira";
                break;
            case 'thu': return "quinta-feira";
                break;
            case 'fri': return "sexta-feira";
                break;
            case 'sat': return "sábado";
                break;
            case 'sun': return "domingo";
                break;
            default: return date("D", $t1);
                break;
        }
    }

    static function getListaMeses() {
        return array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
    }

    static function getNomeMes($data) {
        list($dia, $mes, $ano) = explode("/", $data);
        
        $meses = Plugins_Data::getListaMeses();
        return $meses[(int) $mes];
    }

    static function getDataInicioMesSeguinte($mesAtual, $anoAtual = "", $retornaFormatoDB = true) {
        /*
         * Monta o primeiro dia do mês seguinte.
         * É útil para fazer buscas dentro do período do mês e evitar 
         * que sejam usadas funções dentro do banco de dados para extrair 
         * apenas o nome o número do mês ou dia, pois
         * CAMPOS TIPO DATE/DATETIME SEMPRE PERDEM O DEVIDO
         * ÍNDICE SE ASSOCIADO A FUNÇÕES NA CLÁUSURA WHERE
         * 
         * Lucas: Função atualizada utilizando MKTIME, ele vai considerar mudança 
         * de ano, fevereiro, e qualquer regra de calendário, por padrão sempre
         * utilizar ele. 
         */
        
        return Plugins_Data::datetimeToDB(date("d/m/Y", mktime(0, 0, 0, $mesAtual+1, 1, $anoAtual)));
    }

    static function getPrimeiroDiaMes($mesAtual, $anoAtual = "", $retornaFormatoDB = true) {
        /*
         * Monta o primeiro dia do mês corrente.
         * É útil para fazer buscas dentro do período do mês e evitar 
         * que sejam usadas funções dentro do banco de dados para extrair 
         * apenas o nome o número do mês ou dia, pois
         * CAMPOS TIPO DATE/DATETIME SEMPRE PERDEM O DEVIDO
         * ÍNDICE SE ASSOCIADO A FUNÇÕES NA CLÁUSURA WHERE
         * 
         * Lucas: Função atualizada utilizando MKTIME, ele vai considerar mudança 
         * de ano, fevereiro, e qualquer regra de calendário, por padrão sempre
         * utilizar ele. 
         */
        
        return Plugins_Data::datetimeToDB(date("d/m/Y", mktime(0, 0, 0, $mesAtual, 1, $anoAtual)));
    }

}
