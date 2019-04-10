<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Cursos</h2>  
    <p>Veja seus cursos cadastrados</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <h2>Rotina para atualização de pagamentos.</h2>

                    <p>Informe o caminho e o nome do Arquivo Retorno</p>

                    <p><strong>Passos:</strong></p>
                    <ol>
                        <li>Acessar o site do PAGSEGURO - www.pagseguro.com.br
                        <li>Login, senha 
                        <li>clicar em MINHA CONTA
                        <li>Selecionar o peirodo desejado
                        <li>Clicar em Exportar arquivo (XML), no final do relatorio
                        <li>Aguarde o processamento
                        <li>Clicar emHistorico de arquivos processados
                        <li>Clicar no arquivi criado
                        <li>Sera feito o download do mesmo para sua maquina 
                        <li>Este arquivi devera ser informado
                    </ol>

                    <form method='POST' action="" enctype='multipart/form-data'>
                        <?php
                        $HTMLInput = new HTML_Input("titulo_curso", "file", "titulo_curso", "Arquivo", "", true);
                        $HTMLInput->build();
                        ?>
                        <div class='form-group'>
                            <br />
                            <button type="submit" class="btn btn-primary">Processar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

