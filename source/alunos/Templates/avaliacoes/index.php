<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Avaliações para o módulo: <?php echo $this->modulo->disciplina; ?>
    </h2>  
    <p>Vejas as avaliações disponíveis para este módulo</p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <section class="panel">
                    <header class="panel-heading">
                        Avaliações
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">

                        <?php
                        Error::showAlerts();
                        ?>

                        <table class='table table-striped table-bordered'>
                            <theader>
                                <tr>
                                    <th>Avaliação</th>
                                    <th>Questões</th>
                                    <th>Notas</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                if (!$this->modulo->hasAvaliacaoes()) {
                                    ?>
                                    <tr><td colspan="3">Não há avaliações cadastradas para este módulo</td></tr>
                                    <?php
                                } else
                                    foreach ($this->modulo->avaliacoes() as $avaliacao) {
                                        ?>
                                        <tr>
                                            <td><?php echo $avaliacao->ava_ds_name; ?></td>
                                            <td><?php echo count($avaliacao->questions()); ?></td>
                                            <td><?php echo $this->autorizado->nota($avaliacao->getId()); ?></td>
                                            <td nowrap="nowrap">
                                                <?php
                                                ?>
                                                <?php
                                                if ($this->autorizado->status($avaliacao->getId()) != "concluido") {
                                                    ?>
                                                    <a  class='btn btn-info' href='<?php echo $this->url("alunos", "avaliacoes", "realizar", array("id" => $avaliacao->getId())); ?>'><i class="fa fa-play"></i> Realizar avaliação</a>
                                                    <?php
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>


                            </tbody>
                        </table>

                    </div>
                </section>
                <!--notification end-->
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

