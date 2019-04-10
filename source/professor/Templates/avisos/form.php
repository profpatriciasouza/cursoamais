<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Avisos</h2>  
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
                                Aviso
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("aviso", "hidden", "aviso", "Aviso", "Aviso");
                                $HTMLInput->value = $this->aviso->aviso;
                                $HTMLInput->build();


                                if ($this->aviso->aviso == "a") {
                                    $HTMLInput = new HTML_Input_Checkbox("codigo_aluno", "codigo_aluno", "Alunos", true);
                                    $db = new DB;
                                    $destinatarios = $db->getRows(""
                                            . "SELECT usuarios.usuario_email, "
                                            . "usuarios.Usuario_Nome, "
                                            . "usuarios.codigo_aluno "
                                            . "FROM usuarios_cursos, "
                                            . "usuarios, cursos, modulos "
                                            . "WHERE usuarios.Tipo = 'ueisyes' AND usuarios_cursos.situacao='S' "
                                            . "and usuarios_cursos.codigo_aluno=usuarios.codigo_aluno and "
                                            . "usuarios_cursos.produto=cursos.id and cursos.id=modulos.curso and "
                                            . "modulos.codigo_professor='" . Security::get('codigo_professor') . "' group by usuarios.usuario_nome, usuarios.usuario_email, usuarios.codigo_aluno  ORDER BY usuario_nome");

                                    if ($destinatarios) {
                                        foreach ($destinatarios as $destino) {
                                            $HTMLInput->addOption(new HTML_Input_Checkbox_Option($destino->codigo_aluno, Encoding::utf8($destino->Usuario_Nome), strpos($this->aviso->codigo_aluno, $destino->codigo_aluno) !== false ? true : false));
                                        }
                                    }
                                    $HTMLInput->build();
                                }

                                if ($this->aviso->aviso == "m") {
                                    $HTMLInput = new HTML_Input_Checkbox("codigo_aluno", "codigo_aluno", "Módulo", true);
                                    $modulos = new Model_Modulos();
                                    if (Security::get('tipo') == 'awersaw')
                                        $modulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");

                                    $modulos = $modulos->getRows();
                                    if($modulos) foreach($modulos as $modulo) {
                                        $HTMLInput->addOption(new HTML_Input_Checkbox_Option($modulo->id, Encoding::utf8($modulo->disciplina), strpos($this->aviso->codigo_aluno, $modulo->id) !== false ? true : false));
                                    }
                                    //$HTMLInput->carregaOpcoes(, "id", "disciplina");
                                    $HTMLInput->build();
                                }

                                $HTMLInput = new HTML_Input("aviso_aluno", "textarea", "aviso_aluno", "Mensagem", "", true);
                                $HTMLInput->rows = 10;
                                $HTMLInput->value = Encoding::utf8($this->aviso->aviso_aluno);
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

