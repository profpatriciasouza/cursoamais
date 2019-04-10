<?php
// API PagSeguro
require_once "PagSeguroLibrary/PagSeguroLibrary.php";

// Arquivo do sistema
include_once(dirname(__FILE__) . "/sys.php");

// Conecta ao banco
$db = new DB();

/************************************ Início das funções ************************************/

function escreveArquivo($referencia = NULL, $tipo = 2)
{
    $nome = 'liberacoes.log';
    $data_atual = date('d/m/Y H:i:s');

    if (strlen($referencia) > 0 && $tipo == 2)
        $texto = "              * [$data_atual] Módulo $referencia liberado com sucesso \n";
    elseif ($tipo == 3)
        $texto = "\n-------------------------- Tarefa Finalizada -------------------------- \n\n";
    else
        $texto = "[$data_atual] Verificação de pagamento efetuada com sucesso! \n";

    $arquivo = fopen($nome, 'a');
    fwrite($arquivo, $texto);
    fclose($arquivo);
}

// Liberar módulo pelo resultado do PagSeguro
function liberaModulo(PagSeguroTransactionSearchResult $result, $db)
{
    // Escreve validação da tarefa
    escreveArquivo();

    // Transações
    $transactions = $result->getTransactions();

    // Conta transações
    if (is_array($transactions) && count($transactions) > 0) {

        // Percorrer resultados
        foreach ($transactions as $key => $transactionSummary) {

            // Variáveis para liberação
            $status = $transactionSummary->getStatus()->getValue();
            $referencia = $transactionSummary->getReference();

            // Formata data de pagamento
            $data_pgto = $transactionSummary->getDate();
            $data_pgto = explode('T', $data_pgto);
            $pagamento = $data_pgto[0];

            // Verifica data caso haja erro e se não for virada de ano
            $ano = date('Y');
            if ($pagamento < date('Y-m-d', strtotime("01-01-$ano")) && date('Y-m-d') <> date('Y-m-d', strtotime("01-01-$ano")))
                $pagamento = date('Y-m-d');

            // Valida status
            if (@$status == 3 || @$status == 4) {

                // Id no banco de dados
                $id = (int)$referencia;

                // Buscar módulo e informações no banco
                $query1 = "SELECT md.curso, mda.codigo_aluno, mda.id AS id_autorizacao, md.id AS id_modulo
                   FROM `modulos_autorizados` mda
                   INNER JOIN modulos md
                   WHERE mda.iddis = md.id AND mda.id= '$id'";

                $db_retorno = $db->getRows($query1);
                /*-----------------------------------------------------*/

                // Verifica se houve resultado
                if (@$db_retorno) {

                    // Percorre resultados
                    foreach ($db_retorno AS $dados) {

                        // Libera módulo no banco
                        $query2 = "UPDATE modulos_autorizados SET pagou = 'S', pagto = '$pagamento', liberado = 'S'
                           WHERE id = '{$dados->id_autorizacao}'";

                        @$db->getRows($query2);

                        /*-----------------------------------------------------*/

                        // Libera usuário no banco
                        $query3 = "UPDATE `usuarios_cursos` SET situacao = 'S'
                           WHERE codigo_aluno = '{$dados->id_autorizacao}' AND produto = '{$dados->curso}'";

                        @$db->getRows($query3);

                        escreveArquivo($referencia);
                    }
                }

            }
        }
    }

    // Escreve finalização da tarefa
    escreveArquivo(NULL, 3);
}

/************************************ Fim das funções ************************************/

// Consultar transações no PagSeguro
try {

    // Data atual e data anterior
    $initialDate = date('Y-m-d', strtotime('-1 month')) . "T00:00:00";
    $finalDate = date('Y-m-d') . "T00:00:00";
    $pageNumber = 1;
    $maxPageResults = 1000;

    // Conexão ao PagSeguro
    $credentials = PagSeguroConfig::getAccountCredentials();
    $response = PagSeguroTransactionSearchService::searchByDate(
        $credentials,
        $pageNumber,
        $maxPageResults,
        $initialDate,
        $finalDate
    );

    // Libera Módulos pelos resultados
    liberaModulo($response, $db);

} catch (PagSeguroServiceException $e) {
    die($e->getMessage());
}
?>