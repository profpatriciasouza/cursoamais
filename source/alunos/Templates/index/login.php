<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="#" type="image/png">

        <title>Login</title>

        <link href="<?php echo Map::getRoot(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo Map::getRoot(); ?>assets/css/style-responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?php echo Map::getRoot(); ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo Map::getRoot(); ?>assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">

            <form id="formLogin" class="form-signin" method="POST" action="<?php echo $this->url("login"); ?>">
                <div class="form-signin-heading text-center">
                    <h1 class="sign-title">Login</h1>
                    <img src="/images/logo.png" class="img-responsive" alt="">
                </div>
                <div class="login-wrap">
                    <div class="alert alert-warning fade in hidden">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        Usuário ou senhas inválidos
                    </div>
                    <input type="text" name="email" class="form-control" placeholder="Informe seu usuário" autofocus="" />
                    <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" />
                    <button class="btn btn-lg btn-login btn-block" type="submit">
                        <i class="fa fa-check"></i>
                    </button>
                </div>
            </form>

        </div>

        <div class="devby" style="display:none;">
            Desenvolvido por:<a href="http://duet22.com">duet22</a>
        </div>



        <!-- Placed js at the end of the document so the pages load faster -->

        <!-- Placed js at the end of the document so the pages load faster -->
        <script src="<?php echo Map::getRoot(); ?>assets/js/jquery-1.10.2.min.js"></script>
        <script src="<?php echo Map::getRoot(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Map::getRoot(); ?>assets/js/modernizr.min.js"></script>



    </body>
</html>