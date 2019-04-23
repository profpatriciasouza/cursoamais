<?php

namespace Utility;

defined('ACCESS_PATCH') OR die('No direct script access.');

Class DataReturn
{

    public function json ($success, $message = '', $data = array()) {

        echo json_encode(
            array(
                "success" => $success,
                "message" => $message,
                "data" => $data
            )
        );

        if ($success == true) {
            exit(0); // success *
        } else {
            exit(1); // erro *
        }

    }

}