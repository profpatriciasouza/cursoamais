<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="#" type="image/png">

        <title><?php echo $this->getTitle(); ?></title>
        <meta name="description" content="<?php echo $this->getDescription(); ?>">

        <!--icheck-->
        <link href="<?php echo Map::getRoot(); ?>assets/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
        <link href="<?php echo Map::getRoot(); ?>assets/js/iCheck/skins/square/square.css" rel="stylesheet">
        <link href="<?php echo Map::getRoot(); ?>assets/js/iCheck/skins/square/red.css" rel="stylesheet">
        <link href="<?php echo Map::getRoot(); ?>assets/js/iCheck/skins/square/blue.css" rel="stylesheet">

        <!--dashboard calendar-->
        <link href="<?php echo Map::getRoot(); ?>assets/css/clndr.css" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo Map::getRoot(); ?>assets/js/morris-chart/morris.css">

        <!--common-->
        <link href="<?php echo Map::getRoot(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo Map::getRoot(); ?>assets/css/style-responsive.css" rel="stylesheet">


        <?php
        $this->loadAssets("css");
        $this->head();
        ?>


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="sticky-header">

        <section>
            <!-- left side start-->
            <div class="left-side sticky-left-side">

                <!--logo and iconic logo start-->
                <div class="logo" style='background-color: white;'>
                    <a href="<?php echo $this->url("dashboard"); ?>"><img src="/images/logo.png" class="img-responsive" alt=""></a>
                </div>

                <div class="logo-icon text-center">
                    <a href="<?php echo $this->url("dashboard"); ?>"><img src="/images/logo.jpg" class="img-responsive" alt=""></a>
                </div>
                <!--logo and iconic logo end-->

                <div class="left-side-inner">

                    <!-- visible to small devices only -->
                    <div class="visible-xs hidden-sm hidden-md hidden-lg">
                        <div class="media logged-user">
                            <img alt="" src="assets/images/photos/user-avatar.png" class="media-object">
                            <div class="media-body">
                                <h4><a href="#"><?php echo Security::get("Usuario_Nome"); ?></a></h4>
                                <span>Seja Bem-vindo</span>
                            </div>
                        </div>

                        <h5 class="left-nav-title">Informações da conta</h5>
                        <ul class="nav nav-pills nav-stacked custom-nav">
                            <!--<li><a href="#"><i class="fa fa-user"></i> <span>Meus dados</span></a></li>-->
                            <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>
                        </ul>
                    </div>
                    <?php
                    $smodulo = new Security("modulo");
                    if (Security::hasAccess()) {
                        if (Security::get('tipo') == 1) {

                            // Administrador
                            $menu = array(
                                array(
                                    "Ínicio"
                                    , $this->url("admin")
                                    , "fa fa-home"
                                )
                                , array(
                                    "Cursos"
                                    , array(
                                        array("Cursos", $this->url("admin", "cursos"), "fa fa-file-text-o")
                                        , array("Adicionar cursos", $this->url("admin", "cursos", "add"), "fa fa-download")
                                    )
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Módulos"
                                    , array(
                                        array("Meus módulos", $this->url("modules"), "fa fa-file-text-o")
                                        , array("Adicionar módulo", $this->url("modules", "add"), "fa fa-download")
                                    )
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Alunos"
                                    , array(
                                        array("Alunos", $this->url("admin", "students"), "fa fa-file-text-o")
                                        , array("Adicionar aluno", $this->url("admin", "students", "add"), "fa fa-plus")
                                    )
                                    /* , array(
                                      array("Alunos", $this->url("admin", "students", "index"), "fa fa-graduation-cap")
                                      , array("Adicionar aluno", $this->url("admin", "students", "add"), "fa fa-plus")
                                      ) */
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Professores"
                                    , $this->url("admin", "professores")
                                    /* , array(
                                      array("Alunos", $this->url("admin", "students", "index"), "fa fa-graduation-cap")
                                      , array("Adicionar aluno", $this->url("admin", "students", "add"), "fa fa-plus")
                                      ) */
                                    , "fa fa-users"
                                )
                                , array(
                                    "Fórum"
                                    , $this->url("forum", "manage")
                                    , "fa fa-users"
                                )
                                , array(
                                    "Correio"
                                    , $this->url("professor", "index", "duvidas")
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Mural"
                                    , $this->url("professor", "mural")
                                    , "fa fa-slack"
                                )
                                , array(
                                    "Notícias"
                                    , $this->url("professor", "noticia")
                                    , "fa fa-newspaper-o"
                                ), array(
                                    "Retorno Pagseguro"
                                    , "/XMLadmupload.asp"
                                    /* , array(
                                      array("Alunos", $this->url("admin", "students", "index"), "fa fa-graduation-cap")
                                      , array("Adicionar aluno", $this->url("admin", "students", "add"), "fa fa-plus")
                                      ) */
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Indicadores"
                                    , $this->url("admin", "index", "indicadores")
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Administradores"
                                    , $this->url("admin", "index", "senha")
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Banners"
                                    , $this->url("banners")
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Dados de acesso"
                                    , $this->url("admin", "index", "dados-de-acesso")
                                    , "fa fa-file-text-o"
                                )
                                , array(
                                    "Relatórios"
                                    , "/admrel.asp"
                                    , "fa fa-file-text-o"
                                )
                            );
                        } elseif (Security::get('tipo') == 'awersaw') {
                            $menu = array(
                                array(
                                    "Ínicio"
                                    , $this->url("professor")
                                    , "fa fa-home"
                                )
                                , array(
                                    "Módulos"
                                    , array(
                                        array("Meus módulos", $this->url("modules"), "fa fa-file-text-o")
                                    )
                                    , "fa fa-file-text-o"
                                )
                                , array("Alunos", $this->url("admin", "students"), "fa fa-file-text-o")
                                , array(
                                    "Fórum"
                                    , $this->url("forum", "manage")
                                    , "fa fa-users"
                                )
                                , array(
                                    "Notícias"
                                    , $this->url("professor", "noticia")
                                    , "fa fa-newspaper-o"
                                )
                                , array(
                                    "Correio"
                                    , $this->url("professor", "index", "duvidas")
                                    , "fa fa-file-text-o"
                                )
                                /* , array(
                                  "Avaliações"
                                  , array(
                                  array("Avaliações", $this->url("exam", "manage"), "fa fa-list-ol")
                                  , array("Criar avaliação", $this->url("exam", "manage", "add"), "fa fa-plus")
                                  )
                                  , "fa fa-list-ol"
                                  ) */, array(
                                    "Avisos"
                                    , $this->url("professor", "avisos")
                                    , "fa fa-list-alt"
                                )
                                , array(
                                    "Mural"
                                    , $this->url("professor", "mural")
                                    , "fa fa-slack"
                                )
                            );
                        } else {
                            if ($smodulo->has('modulo') != "") {
                                $menu = array(
                                    array(
                                        "Ver módulos"
                                        , $this->url("alunos", "index", "dashboard")
                                        , "fa fa-home"
                                    )
                                    , array(
                                        "Ínicio"
                                        , $this->url("alunos", "modulos", "index")
                                        , "fa fa-home"
                                    )
                                    , array(
                                        "Conteúdo"
                                        , array(
                                            array("Conteúdo", $this->url("alunos", "modulos", "sobre"), "fa fa-file-text-o")
                                            , array("Aula Inaugural", $this->url("alunos", "modulos", "inaugural"), "fa fa-star")
                                            , array("Matéria", $this->url("alunos", "modulos", "materia"), "fa fa-download")
                                            , array("Apostilas Virtuais", $this->url("alunos", "modulos", "apostilas-virtuais"), "fa fa-globe")
                                            , array("Vídeos", $this->url("alunos", "modulos", "videos"), "fa fa-play")
                                            , array("Leituras indicadas", $this->url("alunos", "modulos", "leituras-indicadas"), "fa fa-book")
                                            , array("Atividades", $this->url("alunos", "modulos", "exercicios"), "fa fa-pencil")
                                            , array(
                                                "Fórum"
                                                , $this->url("forum")
                                                , "fa fa-wechat"
                                            )
                                        )
                                        , "fa fa-file-text-o"
                                    )
                                    , array(
                                        "Avaliações"
                                        , $this->url("alunos", "avaliacoes")
                                        , "fa fa-list-ol"
                                    )
                                    , array(
                                        "Tutor"
                                        , $this->url("alunos", "modulos", "tutor")
                                        , "fa fa-graduation-cap"
                                    )
                                    /* , array(
                                      "Fórum"
                                      , $this->url("forum")
                                      , "fa fa-wechat"
                                      ) */
                                    , array(
                                        "Notícias"
                                        , $this->url("alunos", "noticia")
                                        , "fa fa-newspaper-o"
                                    )
                                    , array(
                                        "Email / Dúvidas"
                                        , $this->url("alunos", "modulos", "duvidas")
                                        , "fa fa-question-circle"
                                    )
                                    , array(
                                        "Enviar arquivo"
                                        , $this->url("alunos", "modulos", "enviar-avaliacao")
                                        , "fa fa-paperclip"
                                    )
                                    , array(
                                        "Notas"
                                        , $this->url("alunos", "modulos", "notas")
                                        , "fa fa-area-chart"
                                    )
                                    , array(
                                        "Certificado"
                                        , $this->url("alunos", "modulos", "certificado")
                                        , "fa fa-file-pdf-o"
                                    )
                                );
                            }
                        }
                        ?>
                        <ul class="nav nav-pills nav-stacked custom-nav">
                            <?php

                            function menuIs($menus) {
                                foreach ($menus as $menu) {
                                    if ($menu[1]->is())
                                        return true;
                                }
                                return false;
                            }

                            function menu($menus) {

                                foreach ($menus as $menu) {
                                    $menu[3] = isset($menu[3]) ? $menu[3] : false;
                                    if (is_object($menu[1])) {
                                        ?>
                                        <li class="<?php echo $menu[1]->is() ? 'active' : '' ?>"><a href="<?php echo $menu[1]; ?>"><i class="<?php echo $menu[2] ?>"></i> <span><?php echo $menu[0] ?></span></a></li>
                                        <?php
                                    } else if (is_string($menu[1])) {
                                        ?>
                                        <li ><a href="<?php echo $menu[1]; ?>"><i class="<?php echo $menu[2] ?>"></i> <span><?php echo $menu[0] ?></span></a></li>
                                        <?php
                                    } else {
                                        ?>
                                        <li class="menu-list <?php echo $menu[3] || menuIs($menu[1]) ? 'active' : '' ?>"><a href="#users"><i class="<?php echo $menu[2] ?>"></i> <span><?php echo $menu[0] ?></span></a>
                                            <ul class="sub-menu-list">
                                                <?php menu($menu[1]); ?>
                                            </ul>
                                        </li>

                                        <?php
                                    }
                                }
                            }

                            if (isset($menu))
                                menu($menu);
                            ?>


                            <li><a href="<?php echo $this->url("exit") ?>"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>

                        </ul>
                        <?php
                    }
                    ?>
                    <!--sidebar nav end-->

                </div>
            </div>
            <!-- left side end-->

            <div class="main-content" >

                <!-- header section start-->
                <div class="header-section">

                    <!--toggle button start-->
                    <a class="toggle-btn"><i class="fa fa-bars"></i></a>
                    <!--toggle button end-->

                    <!--notification menu start -->
                    <div class="menu-right">
                        <ul class="notification-menu">
                            <?php
                            if (Security::hasAccess()) {
                                if (Security::get('tipo') == 'ueisyes') {


                                    $ModelUsuariosCurso = new Model_UsuariosCursos;
                                    $usuarioCurso = $ModelUsuariosCurso->getBycodigo_aluno(Security::get("codigo_aluno"));

                                    $ModelModulos = new Model_Modulos;
                                    $modulos = $ModelModulos->getAllBycurso($usuarioCurso->Produto);
                                    ?>
                                    <li class='form-inline seleciona-modulos'>
                                        <label>Módulos: </label>
                                        <select id='SelecionaModulo' class='form-control'>
                                            <option value=''>Selecione um módulo</option>
                                            <?php
                                            foreach ($modulos as $modulo) {
                                                $ModelModulosAutorizados = new Model_ModulosAutorizados;
                                                $autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $modulo->getId());

                                                if (!$autorizado || $autorizado->liberado != "S") {
                                                    continue;
                                                }
                                                ?>
                                                <option value='<?php echo $this->url("alunos", "modulos", "seleciona", array("id" => $modulo->getId())); ?>'><?php echo Encoding::utf8($modulo->disciplina); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                            <li>
                                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <?php echo Security::get("Usuario_Nome"); ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                    <?php
                                    if (Security::hasAccess()) {
                                        if (Security::get('tipo') == 'ueisyes') {
                                            ?>
                                            <li><a href="<?php echo $this->url('admin', 'students', 'edit', array('id' => Security::get('Ordem'))); ?>"><i class="fa fa-user"></i>  Meus dados</a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <li><a href="<?php echo $this->url("exit"); ?>"><i class="fa fa-sign-out"></i> Sair</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!--notification menu end -->

                </div>
