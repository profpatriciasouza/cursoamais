<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Notícia</h2>  
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
                                Notícias
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input_Select("produto", "produto", "Modulo", true);
                                $HTMLInput->value = $this->noticia->produto;

                                
                                $modulos = new Model_Modulos();
                                if (Security::get('tipo') == 'awersaw')
                                    $modulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");

                                $HTMLInput->carregaOpcoes($modulos, "id", "disciplina", "Seleciona uma disciplina");
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("titulo", "text", "titulo", "Título", "", true);
                                $HTMLInput->value = $this->noticia->titulo;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("mensagem", "textarea", "mensagem", "Mensagem", "", true);
                                $HTMLInput->value = $this->noticia->mensagem;
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

