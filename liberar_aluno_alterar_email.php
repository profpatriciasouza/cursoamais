<?php

include_once(dirname(__FILE__) . "/sys.php");
    $pr = $_GET["pr"];
    $ordem = $_GET["ordem"];


    $db = new DB("usuarios_cursos");
    $sql = "SELECT * FROM usuarios_cursos WHERE codigo_aluno = '".$ordem."' and produto=".$pr;
    $aluno = $db->getRow($sql);
    
    $aluno->Validade_Assinatura = date("Y-m-d", mktime(date("h"), date("i"), date("s"), date("m"), date("d")+180, date("Y")));
    
    $db->update(array("Validade_Assinatura" => $aluno->Validade_Assinatura), "codigo_aluno = '".$ordem."' and produto=".$pr);

    $db = new DB();
    $sql = "SELECT *, Usuario_Nome as un FROM usuarios WHERE codigo_aluno = '".$ordem."'";
    $usuario = $db->getRow($sql);

    $db = new DB();
    $sql = "SELECT * FROM cursos WHERE id = '".$pr."'";
    $curso = $db->getRow($sql);

    $corpo = $usuario->un ." LIBERADO PARA O CURSO : ". $curso->titulo_curso;
/*
    objCDOSYSMail.From = ""
    objCDOSYSMail.To = ""&Meubd2("Usuario_Email")&""
    objCDOSYSMail.Subject = "Liberação de Inscrição"
    ' objCDOSYSMail.AddAttachment "e:\home\Login_de_FTP\Nome_Do_Arquivo"
objCDOSYSMail.Bcc = "profpatriciasouza@yahoo.com.br"
objCDOSYSMail.TextBody = corpo
objCDOSYSMail.Send
set objCDOSYSMail = nothing
set objCDOSYSCon = nothing



Meubd.close

    $db = new DB();
    $db->query($sql);*/

    $mailer = new Mailer;
    $mailer->IsMail();
    $mailer->SMTPAuth = false;
    $mailer->From = "secretariavirtual@conceitoaescolavirtual.com.br";
    $mailer->Subject = "Liberação de Inscrição";
    $mailer->AddAddress($usuario->Usuario_Nome);
    $mailer->AddBCC("profpatriciasouza@yahoo.com.br");
//$mailer->AddAddress("ricardobraga@nobresolutions.com.br");

    $mailer->Body = $corpo;
    $mailer->AltBody = $corpo;

    $mailer->Send();

include("header.php");
?>
<!-- Page Title
============================================= -->
<section id="page-title">
    <div class="container clearfix">
        <h1>Liberação efetuada com sucesso!</h1>

    </div>
</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div id="faqs" class="faqs">



                <div class="col_two_third  nobottommargin">
                    <p align="center">Agora você já pode acessar o seu curso clicando em login no menu superior!</p>

                </div>
            </div>
        </div>
    </div>
</section><!-- #content end -->


<?php
include("footer.php");
