<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Mural</h2>  
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
                                Mural
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                
                                $HTMLInput = new HTML_Input_Select("produto", "produto", "Modulo", true);
                                $HTMLInput->value =$this->mural->produto;

                                
                                $modulos = new Model_Modulos();
                                if (Security::get('tipo') == 'awersaw')
                                    $modulos->where("codigo_professor = '" . Security::get('codigo_professor') . "'");

                                $HTMLInput->carregaOpcoes($modulos, "id", "disciplina", "Seleciona uma disciplina");
                                $HTMLInput->build();
                                
//                                $HTMLInput = new HTML_Input_Select("produto", "produto", "Modulo", true);
//                                $HTMLInput->value = $this->mural->produto;
//                                
//                                $HTMLInput->carregaOpcoes(new Model_Modulos(), "id", "disciplina", "Seleciona uma disciplina");
//                                $HTMLInput->build();
                                
                                $HTMLInput = new HTML_Input("nome", "text", "nome", "Titulo", "", true);
                                $HTMLInput->value = $this->mural->nome;
                                $HTMLInput->build();
                                
                                $HTMLInput = new HTML_Input("mensagem", "textarea", "mensagem", "Mensagem", "", true);
                                $HTMLInput->value = $this->mural->mensagem;
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

