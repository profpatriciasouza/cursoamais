<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Área administrativa</h2>  
    <p>Navegue pelo menu lateral para administrar os dados do sistema</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="col-xs-6">
                <form method="POST" action="">
                    <section class="panel">
                        <header class="panel-heading">
                            Dados de acesso
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-up" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <?php
                            Error::showAlerts();
                            
                            $HTMLInput = new HTML_Input("LOGIN", "text", "LOGIN", "Usuário", "", true);
                            $HTMLInput->value = $this->senha->LOGIN;
                            $HTMLInput->build();
                            ?>
                            <?php
                            $HTMLInput = new HTML_Input("SENHA", "text", "SENHA", "Senha", "", true);
                            $HTMLInput->value = $this->senha->SENHA;
                            $HTMLInput->build();
                            ?>

                            <div class='form-group'>
                                <br />
                                <button type="submit" class="btn btn-primary pull-right">Salvar tudo</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

