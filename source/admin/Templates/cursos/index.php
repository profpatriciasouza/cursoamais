<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Cursos</h2>  
    <p>Veja seus cursos cadastrados</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Listagem de cursos
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
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
                                        <th>Situação</th>
                                        <th>Curso</th>
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    foreach ($this->cursos as $curso) {
                                        ?>
                                        <tr>
                                            <td><?php echo $curso->situacao == "A" ? "Ativo" : "Inativo" ?></td>
                                            <td><?php echo Encoding::utf8($curso->titulo_curso) ?></td>
                                            <td>
                                                <a  class='btn btn-info' href='<?php echo $this->url(Map::$area, "cursos", "edit", array("id" => $curso->getId())); ?>'>Editar</a>
                                                <?php
                                                if ($curso->situacao == "A") {
                                                    ?>
                                                    <a  class='btn btn-danger btn-desativar' href='<?php echo $this->url(Map::$area, "cursos", "delete", array("id" => $curso->getId())); ?>'>Desativar</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a  class='btn btn-success' href='<?php echo $this->url(Map::$area, "cursos", "ativar", array("id" => $curso->getId())); ?>'>Ativar</a>
                                                    <?php
                                                }
                                                ?>
                                                    
                                                    <a  class='btn btn-danger  btn-desativar' href='<?php echo $this->url(Map::$area, "cursos", "force-delete", array("id" => $curso->getId())); ?>'>Excluir</a>
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
</div>
<?php
$this->getFooter();

