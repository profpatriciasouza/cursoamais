<?php

class publico extends Modules_Boot {

    static function boot() {
        System_CONFIG::mapAppend(array(
            'publico' => array(
                'path' => "/source/publico",
                'nameSpace' => 'default',
                'alias' => array(
                    'login' => array(
                        'area' => 'publico',
                        'modulo' => 'index',
                        'acao' => 'login',
                    )
                    ,'esqueci-minha-senha' => array(
                        'area' => 'publico',
                        'modulo' => 'index',
                        'acao' => 'esqueci-minha-senha',
                    )
                    , 'exit' => array(
                        'area' => 'publico',
                        'modulo' => 'index',
                        'acao' => 'logout',
                    )
                    , 'dashboard' => array(
                        'area' => 'publico',
                        'modulo' => 'index',
                        'acao' => 'dashboard',
                    )
                    , 'save-token' => array(
                        'area' => 'publico',
                        'modulo' => 'index',
                        'acao' => 'save-token',
                    )
                )
            )
        ));

        
    }

}

publico::boot();
