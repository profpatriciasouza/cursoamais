<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Mural</h2>  
    <p>Veja todas as mensagens disponíveis no seu mural</p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <section class="panel">
                    <header class="panel-heading">
                        Mural <a  class='btn btn-success' href='<?php echo $this->url("professor", "mural", "add"); ?>'>Adicionar</a>
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
                                    <th>Curso</th>
                                    <th>Titulo</th>
                                    <th>Mensagem</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                if ($this->murais)
                                    foreach ($this->murais as $mural) {
                                        ?>
                                        <tr>
                                            <td><?php echo $mural->disciplina; ?></td>
                                            <td><?php echo $mural->nome; ?></td>
                                            <td><?php echo $mural->mensagem; ?></td>
                                            <td>
                                                <a  class='btn btn-info' href='<?php echo $this->url("professor", "mural", "edit", array("id" => $mural->getId())); ?>'>Editar</a>
                                                <a  class='btn btn-danger' href='<?php echo $this->url("professor", "mural", "delete", array("id" => $mural->getId())); ?>'>Excluir</a>
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

