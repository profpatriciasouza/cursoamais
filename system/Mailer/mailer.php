<?php

require(dirname(__FILE__) . "/class.phpmailer.php");

class Mailer extends PHPMailer {

    public $content;
    public $From = "";
    public $ErrorInfo = "";
    public $mail = "";

    public function __construct() {
        $this->IsMail();
        $this->IsSMTP();
        $this->IsHTML(true);
        $this->CharSet = "UTF-8";
        $this->SMTPAuth = true;
        $SMTPSecure = System_CONFIG::get('SMTP_SECURE');
        if (!empty($SMTPSecure))
            $this->SMTPSecure = $SMTPSecure;
        $this->Host = System_CONFIG::get('SMTP_HOST');
        $SMTPPort = System_CONFIG::get('SMTP_PORT');
        if ($SMTPPort)
            $this->Port = $SMTPPort;
        $this->Username = System_CONFIG::get('SMTP_USERNAME');
        $this->Password = System_CONFIG::get('SMTP_PASSWORD');
        $this->From = $this->Username;
    }

    public function __destruct() {
        $this->SmtpClose();
    }

    public function enviar($to, $titulo, $conteudo, $params = array()) {
        $this->AddAddress($to);
        $this->Subject = $titulo;
        $this->Body = $conteudo;
        $this->AltBody = $conteudo;

        foreach ($params as $k => $param) {
            $this->$k = $param;
        }
        return $this->Send();
    }

}

?>
