<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Avaliação</h2>  
    <p>Veja aqui os dados da avaliação</p>
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
                                Dados da avaliação
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input('ava_ds_name', "text", 'ava_ds_name', "Titulo:", true);
                                $HTMLInput->value = $this->avaliacao->ava_ds_name;
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("ava_ds_description", "textarea", "ava_ds_description", "Descrição", "", true);
                                $HTMLInput->value = $this->avaliacao->ava_ds_description;
                                $HTMLInput->build();
                                ?>

                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>
                        
                        <script>
                            var objQuestiosn = <?php echo $this->avaliacao->ava_js_questions!= "" ? $this->avaliacao->ava_js_questions : "[]"; ?>;
                        </script>
                        <section class="panel">
                            <header class="panel-heading">
                                Questões
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <div class="col-xs-4">
                                    <?php
                                    $HTMLInput = new HTML_Input('question-title', "text", 'question-title', "Enunciado", "Informe o enunciado da questão");
                                    $HTMLInput->build();
                                    
                                    $HTMLInput = new HTML_Input('question-peso', "money", 'question-peso', "Peso", "Informe o peso da questão");
                                    $HTMLInput->build();

                                    $HTMLInput = new HTML_Input("question-description", "textarea", "question-description", "Descrição", "", true);
                                    $HTMLInput->build();
                                    ?>
                                    
                                    <div id="questoes"></div>
                                    <div class='form-group'>
                                        <button type="button" class="btn btn-success btn-add-option"><i class="fa fa-plus"></i> Adicionar opção</button>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <table id="lista-questoes" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Questão</th>
                                                <th>Opções</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="to-delete">
                                                <td colspan="3">Não há questões para esta avaliação</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-12">
                                    <div class='form-group'>
                                        <button type="button" class="btn btn-primary btn-add-question">Salvar questão</button>
                                    </div>
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

