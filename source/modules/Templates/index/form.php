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
                                Dados do módulo
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                if (Security::get('tipo') == 'awersaw') {
                                    $HTMLInput = new HTML_Input('curso', "hidden", 'curso', "Curso", true);
                                    $HTMLInput->value = Encoding::utf8($this->modulo->curso);
                                    $HTMLInput->build();
                                } else {
                                    $HTMLInput = new HTML_Input_Select('curso', 'curso', "Curso", true);
                                    $HTMLInput->value = Encoding::utf8($this->modulo->curso);
                                    $HTMLInput->carregaOpcoes(new Model_Cursos, "id", "titulo_curso", "Selecione um curso");

                                    $HTMLInput->build();
                                }

                                if (Security::get('tipo') == 'awersaw') {
                                    $HTMLInput = new HTML_Input('codigo_professor', "hidden", 'codigo_professor', "Professor", true);
                                    $HTMLInput->value = Encoding::utf8($this->modulo->codigo_professor);
                                    $HTMLInput->build();
                                } else {
                                    //SELECT * FROM usuarios WHERE tipo = 'awersaw' ORDER BY usuario_nome
                                    $ModelUsuarios = new Model_Usuarios;
                                    $ModelUsuarios->where("tipo = 'awersaw'");
                                    $ModelUsuarios->orderby("usuario_nome ASC");


                                    $HTMLInput = new HTML_Input_Select('codigo_professor', 'codigo_professor', "Professor", true);
                                    $HTMLInput->value = $this->modulo->codigo_professor;
                                    $HTMLInput->carregaOpcoes($ModelUsuarios, "codigo_professor", "Usuario_Nome", "Selecione um professor");

                                    $HTMLInput->build();
                                }
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("disciplina", "text", "disciplina", "Módulo", "", true);
                                $HTMLInput->value = Encoding::utf8($this->modulo->disciplina);
                                if (Security::get('tipo') == 'awersaw')
                                    $HTMLInput->readonly = "readonly";
                                $HTMLInput->build();

                                if (Security::get('tipo') != 'awersaw') {
                                    $HTMLInput = new HTML_Input("valor", "money", "valor", "Valor", "", true);
                                    $HTMLInput->value = $this->modulo->valor;
                                    $HTMLInput->build();
                                }


                                $HTMLInput = new HTML_Input("carga", "text", "carga", "Carga horária", "", true);
                                $HTMLInput->value = $this->modulo->carga;
                                if (Security::get('tipo') == 'awersaw')
                                    $HTMLInput->readonly = "readonly";
                                $HTMLInput->build();
                                ?>

                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>

                        <?php
                        $this->getFile("index/form-calendario.php");
                        $this->getFile("index/form-conteudo.php");
                        $this->getFile("index/form-inaugural.php");
                        $this->getFile("index/form-materias.php");
                        //$this->getFile("index/form-virtual.php");
                        //$this->getFile("index/form-videos.php");
                        $this->getFile("index/form-exercicios.php");
                        $this->getFile("index/form-oque-ler.php");
                        //$this->getFile("index/form-final.php");
                        ?>
                    </form>


                    <!--notification end-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

