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

                    <form method='POST' action="<?php echo $this->urlByAcao("salvar", Map::get('id')) ?>" enctype='multipart/form-data'>
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
                                $questoes = $this->autorizado->questoes(Map::get("avaliacao"));
                                foreach ($questoes as $question) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-12" for="inputSuccess"><strong>Questão <?php echo $question->id ?>:</strong> <?php echo $question->title ?></label>
                                        <div class="col-lg-12">
                                            <p><?php echo $question->description ?></p>
                                            <?php
                                            if ($question->correct === false) {
                                                ?>
                                                <div class="alert alert-danger">Esta questão não possui alternativa correta!</div>
                                                <?php
                                            }


                                            foreach ($question->options as $option) {
                                                if (!$option->status)
                                                    continue;
                                                ?>
                                                <div class="radio ">
                                                    <label>
                                                        <input disabled="disabled" type="radio" <?php echo $option->id == $question->choose ? "checked='checked'" : ""; ?> name="Question[<?php echo $question->id ?>]" id="optionsRadios1" value="<?php echo $option->id ?>">
                                                        <?php echo $option->id == $question->correct ? "<i class='fa fa-check'></i>" : ""; ?>
                                                        <?php echo $option->id == $question->choose && $option->id != $question->correct ? "<i class='fa fa-times'></i>" : ""; ?>

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

