<?php
include_once(dirname(__FILE__)."/sys.php")
?><!DOCTYPE html>
<html dir="ltr" lang="en-US">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />
        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />

        <link rel="stylesheet" href="/canvas.css" type="text/css" />
        <link rel="stylesheet" href="/custom.css" type="text/css" />
        <link rel="stylesheet" href="/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="/css/responsive.css" type="text/css" />
        <link rel="stylesheet" href="/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            .line { margin: 15px 0 !important; }
        </style>
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <!-- External JavaScripts
        ============================================= -->
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/plugins.js"></script>
        <script src="/assets/js/less.min.js"></script>
        <!-- Document Title
        ============================================= -->
        <title><?php

        if(isset($curso)) {
            echo $curso->titulo_curso;
        }

        ?>Cursos a mais</title>
    </head>

    <body class="stretched">
        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">
            <!-- Header
            ============================================= -->
            <header id="header" class="full-header">
                <div id="header-wrap">
                    <div class="container clearfix">
                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                        <!-- Logo
                        ============================================= -->
                        <div id="logo">
                            <a href="/" class="standard-logo" data-dark-logo="/images/logo-dark.png"><img src="/images/logo-conceito.png" alt="Cursos a mais"></a>
                            <a href="/" class="retina-logo" data-dark-logo="/images/logo-dark@2x.png"><img src="/images/logo.png" alt="Cursos a mais"></a>
                        </div>
                        <!-- #logo end -->
                        <!-- Primary Navigation
                        ============================================= -->
                        <nav id="primary-menu">
                            <ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1500">
                                <li>
                                    <a href="#quem-somos" data-href="#quemsomos">
                                        <div>Quem Somos</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#duvidas" data-href="#duvidas">
                                        <div>Dúvidas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#nossos-cursos" data-href="#nossoscursos">
                                        <div>Cursos</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#contato" data-href="#contato">
                                        <div>Contato</div>
                                    </a>
                                </li>
                                <li class=="sm-hidden md-hidden lg-hidden">
                                  <a href="/acesso.php">
                                      <div>Login</div>
                                  </a>
                                </li>
                            </ul>
                            <!-- Top Cart
                            ============================================= -->
                            <!--<div id="top-cart">
                                <a href="/acesso.php">
                                    <h5>Login</h5>
                                </a>
                            </div>-->
                            <!-- #top-cart end -->
                        </nav>
                        <!-- #primary-menu end -->
                    </div>
                </div>
            </header>
