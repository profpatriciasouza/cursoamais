<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Professores</h2>  
    <p>Veja seus cursos cadastrados</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Professores <a class="btn btn-success" href="<?php echo $this->url('admin', 'professores', 'add'); ?>"><i class="fa fa-plus"></i> Adicionar professor</a>
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
                                        <th>Professor</th>
                                        <th>Usuário</th>
                                        <th>Acessos</th>
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    foreach ($this->usuarios as $usuario) {
                                        ?>
                                        <tr>
                                            <td><?php echo Encoding::isUTF8($usuario->Usuario_Nome) ? $usuario->Usuario_Nome : utf8_encode($usuario->Usuario_Nome); ?></td>
                                            <td><?php echo $usuario->Usuario_Login; ?></td>
                                            <td><?php echo $usuario->QuantidadeAcessos; ?></td>
                                            <td>
                                                <a class='btn btn-info' href='<?php echo $this->url('admin', 'professores', 'edit', array("id" => $usuario->getId())); ?>'>editar</a>
                                                <a class='btn btn-danger btn-delete' href='<?php echo $this->url('admin', 'professores', 'delete', array("id" => $usuario->getId())); ?>'>excluir</a>
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

