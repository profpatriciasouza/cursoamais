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
                    <!--notification start-->

                    <?php
                    Error::showAlerts();
                    ?>

                    <form method='POST' action="" enctype='multipart/form-data'>
                        <section class="panel">
                            <header class="panel-heading">
                                Dados do Aluno
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("cpf", "text", "cpf", "CPF", "", true);
                                $HTMLInput->value = $this->aluno->cpf;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Usuario_Login", "text", "Usuario_Login", "Login", "", true);
                                $HTMLInput->value = $this->aluno->Usuario_Login;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Usuario_Senha", "text", "Usuario_Senha", "Senha", "", true);
                                $HTMLInput->value = $this->aluno->Usuario_Senha;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Usuario_Nome", "text", "Usuario_Nome", "Nome", "", true);
                                $HTMLInput->value = Encoding::utf8($this->aluno->Usuario_Nome);
                                $HTMLInput->build();


                                $HTMLInput = new HTML_Input("filiacao_pai", "text", "filiacao_pai", "Pai", "", true);
                                $HTMLInput->value = Encoding::utf8($this->aluno->filiacao_pai);
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("filiacao_mae", "text", "filiacao_mae", "Mãe", "", true);
                                $HTMLInput->value = Encoding::utf8($this->aluno->filiacao_mae);
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input_Select("sexo", "sexo", "Sexo", "", true);
                                $HTMLInput->value = $this->aluno->sexo;
                                $HTMLInput->addOption(new HTML_Input_Select_Option("FEMININO", "Feminino"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("MASCULINO", "Masculino"));
                                $HTMLInput->build();


                                $HTMLInput = new HTML_Input("Data_nascimento", "text", "Data_nascimento", "Data de Nascimento", "", true);
                                $HTMLInput->value = $this->aluno->Data_nascimento;
                                $HTMLInput->mask = "00/00/0000";
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("rg", "text", "rg", "RG", "", true);
                                $HTMLInput->value = $this->aluno->rg;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("CEP", "text", "CEP", "CEP", "", true);
                                $HTMLInput->value = $this->aluno->CEP;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Endereco", "text", "Endereco", "Endereço", "", true);
                                $HTMLInput->value = $this->aluno->Endereco;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("numero", "text", "numero", "Número", "", true);
                                $HTMLInput->value = $this->aluno->numero;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("complemento", "text", "complemento", "Complemento", "", true);
                                $HTMLInput->value = $this->aluno->complemento;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Bairro", "text", "Bairro", "Bairro", "", true);
                                $HTMLInput->value = $this->aluno->Bairro;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Cidade", "text", "Cidade", "Cidade", "", true);
                                $HTMLInput->value = $this->aluno->Cidade;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input_Select("Estado", "Estado", "Estado", "", true);
                                $HTMLInput->value = $this->aluno->Estado;
                                $HTMLInput->addOption(new HTML_Input_Select_Option("AC", "AC"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("AL", "AL"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("AP", "AP"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("AM", "AM"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("BA", "BA"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("CE", "CE"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("DF", "DF"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("ES", "ES"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("GO", "GO"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("MA", "MA"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("MT", "MT"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("MS", "MS"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("MG", "MG"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("PA", "PA"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("PB", "PB"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("PR", "PR"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("PE", "PE"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("PI", "PI"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("RJ", "RJ"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("RN", "RN"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("RS", "RS"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("RO", "RO"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("RR", "RR"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("SC", "SC"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("SP", "SP"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("SE", "SE"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("TO", "TO"));
                                $HTMLInput->addOption(new HTML_Input_Select_Option("RJ", "RJ"));
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Telefone", "text", "Telefone", "Telefone", "", true);
                                $HTMLInput->value = $this->aluno->Telefone;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Usuario_Email", "text", "Usuario_Email", "Usuario_Email", "", true);
                                $HTMLInput->value = $this->aluno->Usuario_Email;
                                $HTMLInput->build();

                                if (Security::get('tipo') != 'ueisyes') {

                                    $HTMLInput = new HTML_Input_Select("usuarios_cursos[Produto]", "usuarios_cursos[Produto]", "Curso");
                                    $HTMLInput->value = $this->aluno->curso()->Produto;
                                    $HTMLInput->carregaOpcoes(new Model_Cursos(), "id", "titulo_curso");
                                    $HTMLInput->build();


                                    $HTMLInput = new HTML_Input("usuarios_cursos[Validade_Assinatura]", "data", "usuarios_cursos[Validade_Assinatura]", "Validade da assinatura", "", true);
                                    $HTMLInput->value = $this->aluno->Usuario_Email;
                                    //$HTMLInput->build();

                                    $HTMLInput = new HTML_Input("usuarios_cursos[desconto]", "data", "usuarios_cursos[desconto]", "Desconto", "", true);
                                    $HTMLInput->value = $this->aluno->Usuario_Email;
                                    $HTMLInput->build();

                                    $HTMLInput = new HTML_Input_Select("usuarios_cursos[quemindicou]", "usuarios_cursos[quemindicou]", "Quem indicou");
                                    $HTMLInput->value = $this->aluno->curso()->quemindicou;
                                    $HTMLInput->carregaOpcoes(new Model_Indicadores(), "Ordem", "Usuario_Nome");
                                    $HTMLInput->build();
                                }
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

