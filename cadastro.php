<?php
include_once(dirname(__FILE__) . "/sys.php");

if ($_POST) {
    $post = $_POST;

    $post['Indicou'] = isset($post['Indicou']) ? $post['Indicou'] : 0;

    $name = $post['Nome'].' '.$post['sobrenome'];
    $accept = isset($_POST['AceitoReceberEmail']) ? $_POST['AceitoReceberEmail'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $cel_phone = isset($_POST['whatsapp']) ? $_POST['whatsapp'] : null;
    $login = isset($_POST['login']) ? $_POST['login'] : $post['Email'];

    $db = new DB("usuarios");
    $usuario = $db->getRow("SELECT * FROM usuarios WHERE cpf = '" . $post['CPF'] . "'");

    if (!$usuario) {
        $sql = ""
                . "INSERT "
                . "INTO "
                . "usuarios "
                . "(Usuario_Login, Usuario_Senha, tipo, Usuario_Nome, Usuario_Email, codigo_professor, codigo_aluno, cpf, Usuario_DataCadastro, Telefone, Tel_celular,  AceitoReceberEmail) "
                . "VALUES "
                . "('" . $login . "', '" . $post['Senha'] . "', 'ueisyes'"
                . ", '" . $name . "', '" . $post['Email'] . "', '" . md5($post['Nome']) . "', "
                . "'" . md5($post['Nome']) . "', '" . $post['CPF'] . "', '" . date("Y-m-d H:i:s") . "', '".$phone."', '".$cel_phone."', '".$accept."')";

        $db = new DB();
        $db->query($sql);

        $Ordem = mysql_insert_id();
    } else {
        $Ordem = $usuario->Ordem;
    }


    $db = new DB();
    $usuario = $db->getRow("SELECT * FROM usuarios WHERE Ordem = '" . $Ordem . "'");
    $db = new DB();
    $curso = $db->getRow("SELECT * FROM cursos WHERE id = '" . $post['curso'] . "'");


    $sql = "INSERT "
            . "INTO "
            . "usuarios_cursos (Usuario_Login, Usuario_Senha, Usuario_DataCadastro, "
            . "Usuario_QuantidadeAcessos, Produto, codigo_aluno, quemindicou) "
            . "VALUES ('" . $post['Email'] . "', '" . $post['Senha'] . "', '" . date("Y-m-d H:i:s") . "',"
              . " 0,  '" . $post['curso'] . "','" . $usuario->codigo_aluno . "', '" . $post['Indicou'] . "')";

    $db = new DB();
    $db->query($sql);

    $corpo = "Nome: " . $post['Nome'] . "<br />"
            . "Email: " . $post['Email'] . "<br />"
            . "Usuário: " . $post['Email'] . "<br />"
            . "Senha: " . $post['Senha'] . "<br />"
            . "Curso: " . $curso->titulo_curso . "<br />";

    $mailer = new Mailer;
    $mailer->IsMail();
    $mailer->SMTPAuth = false;
    $mailer->From = "atendimento@cursosamais.com.br";
    $mailer->Subject = "URGENTE - MATRÍCULA EFETUADA";
    $mailer->AddAddress("profpatriciasouza@yahoo.com.br");
//$mailer->AddAddress("ricardobraga@nobresolutions.com.br");

    $mailer->Body = $corpo;
    $mailer->AltBody = $corpo;

    $mailer->Send();


    $strmsg = "Prezado(a) " . $post['Nome'] . "<br />";
    $strmsg = $strmsg . "Confirmamos o recebimento do seu Requerimento de Matrícula para o Curso " . $curso->titulo_curso . "<br />";
    $strmsg = $strmsg . "Certifique-se de que leu atentamente as informações contidas no curso/evento escolhido;" . "<br />";
    $strmsg = $strmsg . "Siga as instruções abaixo:" . "<br />";
    $strmsg = $strmsg . "1)      Confirmação de login e senha através do link ao final desta orientação;" . "<br />";
    $strmsg = $strmsg . "2)      Entre, novamente, em  www.cursosamais.com.br e  digite seu login e senha de acesso;" . "<br />";
    $strmsg = $strmsg . "        ** Login : " . $login . "<br />";
    $strmsg = $strmsg . "        ** Senha : " . $post['Senha'] . "<br />";
    $strmsg = $strmsg . "3)      Verifique se há boletos de pagamento ao lado do módulo/disciplina/evento;" . "<br />";
    $strmsg = $strmsg . "4)      Em caso positivo, imprima-o e pague para liberação automática do banco;" . "<br />";
    $strmsg = $strmsg . "5)      Em caso negativo, aguarde envio de e-mail com boleto para pagamento e a liberação do módulo/disciplina/evento em até 48h (exceto feriados e finais de semana);" . "<br />";
    $strmsg = $strmsg . "6)      Entre, constantemente, no ambiente virtual para verificar avisos dirigidos a você e informações importantes para continuidade e esclarecimentos de sua participação." . "<br />";
    $strmsg = $strmsg . "7)      Em caso de dúvidas e/ou informações adicionais há um item contato, use-o." . "<br />";
    $strmsg = $strmsg . "Seja bem-vindo (a)  a  Cursos A+." . "<br />";
    $strmsg = $strmsg . "Confirme seu login e senha através deste link de liberação:" . "<br />";
    $strmsg = $strmsg . "http://www.cursosamais.com.br/liberar_aluno_alterar_email.php?pr=" . $curso->id . "&ordem=" . $usuario->codigo_aluno . "<br />";
    $strmsg = $strmsg . "Atenciosamente";
    $strmsg = $strmsg . "Cursos A+";


    $mailer = new Mailer;
    $mailer->IsMail();
    $mailer->SMTPAuth = false;
    $mailer->From = "atendimento@cursosamais.com.br";
    $mailer->Subject = "RECEBIMENTO DE MATRÍCULA";
    $mailer->AddAddress($post['Email']);
    $mailer->AddBCC("profpatriciasouza@yahoo.com.br");

    $mailer->Body = $strmsg;
    $mailer->AltBody = $strmsg;

    $mailer->Send();
}

include("header.php");
?>
<!-- Page Title
============================================= -->
<section id="page-title">
    <div class="container clearfix">
        <h1>Cadastro realizado com sucesso!</h1>

    </div>
</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div id="faqs" class="faqs">



                <div class="col_two_third  nobottommargin">
                    <p align="center">Você receberá um email com instruções. Caso não receba, entre em contato conosco atendimento@cursosamais.com.br.</p>

                </div>
            </div>
        </div>
    </div>
</section><!-- #content end -->


<?php
include("footer.php");
