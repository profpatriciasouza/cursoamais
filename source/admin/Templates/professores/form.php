<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Professores</h2>  
    <p>Tela de edição e cadastro de professores</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->

                    <?php
                    Error::showAlerts();
                    ?>

                    <form method='POST' action="" enctype='multipart/form-data'>
                        <section class="panel">
                            <header class="panel-heading">
                                Dados do Professor
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("foto_aluno", "file", "foto_aluno", "Foto", "", true);
                                $HTMLInput->value = $this->usuario->foto_aluno;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Usuario_Nome", "text", "Usuario_Nome", "Nome", "", true);
                                
                                $HTMLInput->value = Encoding::isUTF8($this->usuario->Usuario_Nome) ? $this->usuario->Usuario_Nome : utf8_encode($this->usuario->Usuario_Nome);
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("cpf", "text", "cpf", "CPF", "", true);
                                $HTMLInput->value = $this->usuario->cpf;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("rg", "text", "rg", "RG", "", true);
                                $HTMLInput->value = $this->usuario->rg;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("filiacao_mae", "text", "filiacao_mae", "Mãe", "", true);
                                $HTMLInput->value = $this->usuario->filiacao_mae;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("filiacao_pai", "text", "filiacao_pai", "Pai", "", true);
                                $HTMLInput->value = $this->usuario->filiacao_pai;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Data_nascimento", "data", "Data_nascimento", "Data de nascimento", "", true);
                                $HTMLInput->value = $this->usuario->Data_nascimento;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("curriculo", "textarea", "curriculo", "Currículo", "", true);
                                $HTMLInput->value = Encoding::isUTF8($this->usuario->curriculo) ? $this->usuario->curriculo : utf8_encode($this->usuario->curriculo);
                                $HTMLInput->build();
                                ?>

                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                Dados de acesso
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-up" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("Usuario_Login", "text", "Usuario_Login", "Usuário", "", true);
                                $HTMLInput->value = $this->usuario->Usuario_Login;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Usuario_Senha", "text", "Usuario_Senha", "Senha", "", true);
                                $HTMLInput->value = $this->usuario->Usuario_Senha;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("QuantidadeAcessos", "text", "QuantidadeAcessos", "Acessos", "", true);
                                $HTMLInput->value = $this->usuario->QuantidadeAcessos;
                                //$HTMLInput->readonly = "readonly";
                                $HTMLInput->build();
                                ?>
                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                Endereço
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("CEP", "text", "CEP", "CEP", "", true);
                                $HTMLInput->value = $this->usuario->CEP;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Estado", "text", "Estado", "Estado", "", true);
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Cidade", "text", "Cidade", "Cidade", "", true);
                                $HTMLInput->value = $this->usuario->Cidade;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Endereco", "text", "Endereco", "Endereço", "", true);
                                $HTMLInput->value = $this->usuario->Endereco;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("numero", "text", "numero", "Número", "", true);
                                $HTMLInput->value = $this->usuario->numero;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("complemento", "text", "complemento", "Complemento", "", true);
                                $HTMLInput->value = $this->usuario->complemento;
                                $HTMLInput->build();
                                ?>
                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                Dados de contato
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("Telefone", "text", "Telefone", "Telefone", "", true);
                                $HTMLInput->value = $this->usuario->Telefone;
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Usuario_Email", "text", "Usuario_Email", "E-mail", "", true);
                                $HTMLInput->value = $this->usuario->Usuario_Email;
                                $HTMLInput->build();
                                ?>

                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>


                    </form>


                    <!--notification end-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

