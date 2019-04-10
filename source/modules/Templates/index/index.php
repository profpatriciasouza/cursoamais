<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Módulos 
        <?php
        if (Security::get('tipo') != 'awersaw') {
            ?>
            <a class="btn btn-success" href="<?php echo $this->url("modules", "add") ?>"><i class="fa fa-plus"></i> Adicionar módulo</a>
        <?php } ?>
    </h2>  
    <p>Veja o curso e seus módulos</p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <section class="panel">
                    <header class="panel-heading">
                        Módulos
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">

                        <?php
                        Error::showAlerts();
                        ?>

                        <form method="POST" action="<?php echo $this->urlByAcao("posicao"); ?>">
                        <table class='table table-striped table-bordered'>
                            <theader>
                                <tr>
                                    <td colspan="4"><div class="pull-right"><button class="btn btn-primary" type="submit">salvar</button></div></td>
                                </tr>
                                <tr>
                                    <th>Curso</th>
                                    <th>Módulo</th>
                                    <th>Posição</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($this->modulos as $modulo) {
                                    if($modulo->posicao=="") {
                                        $modulo->posicao = $i;
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo Encoding::isUTF8($modulo->titulo_curso) ? $modulo->titulo_curso : utf8_encode($modulo->titulo_curso); ?></td>
                                        <td><?php echo Encoding::isUTF8($modulo->disciplina) ? $modulo->disciplina : utf8_encode($modulo->disciplina); ?></td>
                                        <td><input type="text" class="form-control" name="pos[<?php echo $modulo->getId()?>]" value="<?php echo $modulo->posicao; ?>" /></td>
                                        <td nowrap="nowrap">
                                            <a  class='btn btn-info' href='<?php echo $this->url("modules", "edit", array("id" => $modulo->id)); ?>'><i class="fa fa-edit"></i> Editar</a>

                                            <?php
                                            if (Security::get('tipo') != 'awersaw') {
                                                ?>
                                                <a  class='btn btn-danger' href='<?php echo $this->url("modules", "delete", array("id" => $modulo->id)); ?>'><i class="fa fa-times"></i> excluir</a>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($modulo->hasArquivos()) {
                                                ?>
                                                <a class='btn btn-success' href='<?php echo $this->url("modules", "uploads", array("id" => $modulo->getId())); ?>'><i class="fa fa-file"></i> Arquivos (<?php echo count($modulo->arquivos()) ?>)</a>
                                                <?php
                                            }
                                            ?>
                                            <a  class='btn btn-default' href='<?php echo $this->url("modules", "avaliacao", "index", array("id" => $modulo->id)); ?>'>Avaliações (<?php if ($modulo->avaliacoes()) echo count($modulo->avaliacoes()); ?>)</a>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                    if($modulo->posicao==$i) {
                                        $i+=10;
                                    }
                                }
                                ?>


                                <tr>
                                    <td colspan="4"><div class="pull-right"><button class="btn btn-primary" type="submit">salvar</button></div></td>
                                </tr>
                            </tbody>
                        </table>

                        </form>
                    </div>
                </section>
                <!--notification end-->
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

