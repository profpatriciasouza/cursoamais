<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Área do professor</h2>  
    <p>Navegue através do menu a esquerda para acessar as opções do seu sistema</p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <section class="panel">
                    <header class="panel-heading">
                        Listagem de cursos
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>

                            <a class="fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">

                        <p>Veja abaixo todos os tópicos abertos para discussão</p>

                        <?php
                        Error::showAlerts();
                        ?>

                        <table class='table table-striped table-bordered'>
                            <theader>
                                <tr>
                                    <th>Curso</th>
                                    <th>Módulo</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                if ($this->modulos)
                                    foreach ($this->modulos as $modulo) {
                                        ?>
                                        <tr>
                                            <td><?php echo Encoding::utf8($modulo->curso()->titulo_curso); ?></td>
                                            <td><?php echo Encoding::utf8($modulo->disciplina); ?></td>
                                            <td>
                                                <a class='btn btn-info' href='<?php echo $this->url("modules", "edit", array("id" => $modulo->getId())); ?>'>Editar</a>
                                                <?php
                                                if ($modulo->hasArquivos()) {
                                                    ?>
                                                    <a class='btn btn-success' href='<?php echo $this->url("modules", "uploads", array("id" => $modulo->getId())); ?>'> Arquivos (<?php echo count($modulo->arquivos()) ?>)</a>
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

