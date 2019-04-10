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

                    <form method='POST' action="<?php echo $this->urlByAcao("salvar", Map::get('id'))?>" enctype='multipart/form-data'>
                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo $this->avaliacao['ava_ds_name']; ?>
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <p>
                                    <?php
                                    echo $this->avaliacao['ava_ds_description'];
                                    ?>
                                </p>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                Questões
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $questoes = json_decode($this->avaliacao['ava_js_questions']);
                                foreach ($questoes as $question) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-12" for="inputSuccess"><strong>Questão <?php echo $question->id ?>:</strong> <?php echo $question->title ?></label>
                                        <div class="col-lg-12">
                                            <p><?php echo $question->description ?></p>
                                            <?php
                                            foreach ($question->options as $option) {
                                                if (!$option->status)
                                                    continue;
                                                ?>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="Question[<?php echo $question->id ?>]" id="optionsRadios1" value="<?php echo $option->id ?>">
                                                        <?php echo $option->title ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="col-xs-12">
                                    <div class="alert alert-danger" >
                                        Atenção! Ao concluir avaliação esta não poderá ser mais alterada e sua nota será processada!
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class='form-group'>
                                        <button type="submit" class="btn btn-primary btn-add-question">Concluir avaliação</button>
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

