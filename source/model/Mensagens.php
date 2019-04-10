<?php

class Model_Mensagens extends DB_Model {

    public $nomeTabela = "mensagens";
    public $chavePrimaria = "id";
    public $select = "id, codigo, destinatario, assunto, `data` as data_mensagem, mensagem, nomearquivo, caminho, remetente, Img_email, idmodulo, codigo_aluno";

}
