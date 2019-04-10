<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Notícia</h2>  
    <p>Veja todas as notícias cadastradas no seu noticia</p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <section class="panel">
                    <header class="panel-heading">
                        Notícias <a  class='btn btn-success' href='<?php echo $this->url("professor", "noticia", "add"); ?>'>Adicionar</a>
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
                                if ($this->noticias)
                                    foreach ($this->noticias as $noticia) {
                                        ?>
                                        <tr>
                                            <td><?php echo $noticia->disciplina; ?></td>
                                            <td><?php echo $noticia->titulo; ?></td>
                                            <td><?php echo $noticia->mensagem; ?></td>
                                            <td>
                                                <a  class='btn btn-info' href='<?php echo $this->url("professor", "noticia", "edit", array("id" => $noticia->getId())); ?>'>Editar</a>
                                                <a  class='btn btn-danger' href='<?php echo $this->url("professor", "noticia", "delete", array("id" => $noticia->getId())); ?>'>Excluir</a>
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

