<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Avaliações para o módulo: <?php echo $this->modulo->disciplina; ?>
        <a class="btn btn-success" href="<?php echo $this->urlByAcao("add", Map::get('id')) ?>"><i class="fa fa-plus"></i> Adicionar avaliação</a>
    </h2>  
    <p>Veja as avaliações cadastradas para o seu módulo</p>
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
                                            <td nowrap="nowrap">
                                                <a  class='btn btn-info' href='<?php echo $this->url("modules", "avaliacao", "edit", array("id" => Map::get('id'), 'ava' => $avaliacao->getId())); ?>'><i class="fa fa-edit"></i> Editar</a>
                                                <?php
                                                if ($avaliacao->ava_in_status == 1) {
                                                    ?>
                                                    <a  class='btn btn-ajax btn-danger' href='<?php echo $this->url("modules", "avaliacao", "delete", array("id" => Map::get('id'), 'ava' => $avaliacao->getId())); ?>'><i class="fa fa-times"></i> Desativar</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a  class='btn btn-ajax btn-success' href='<?php echo $this->url("modules", "avaliacao", "activate", array("id" => Map::get('id'), 'ava' => $avaliacao->getId())); ?>'><i class="fa fa-times"></i> Ativar</a>

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

