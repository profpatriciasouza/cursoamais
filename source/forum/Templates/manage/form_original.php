<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Edição de tópico</h2>  
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->

                    <?php
                    Error::showAlerts();
                    ?>

                    <form method='POST' action=""  enctype='multipart/form-data'>
                        <section class="panel">
                            <header class="panel-heading">
                                Cadastro de fórum
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input_Select("produto", "produto", "Módulos", true);
                                $HTMLInput->value = $this->topico->produto;
                                $modulos = new Model_Modulos;
                                if (Security::get('tipo') == 'awersaw') {
                                    $modulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");
                                }
                                $modulos->join('cursos');
                                $HTMLInput->carregaOpcoes($modulos, "id", "disciplina", "Selecione um módulo");
                                $HTMLInput->build();


                                $HTMLInput = new HTML_Input("Author", "hidden", "Author", "Autor", "", true);
                                $HTMLInput->value = Encoding::utf8($this->topico->Author);
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("Title", "text", "Title", "Titulo", "", true);
                                $HTMLInput->value = Encoding::utf8($this->topico->Title);
                                $HTMLInput->build();


                                $HTMLInput = new HTML_Input("Body", "textarea", "Body", "Mensagem", "", true);
                                $HTMLInput->value = Encoding::utf8($this->topico->Body);
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

