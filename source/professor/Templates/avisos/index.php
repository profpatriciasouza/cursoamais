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
                        Avisos para alunos <a class='btn btn-success' href='<?php echo $this->url("professor", "avisos", "add", array("aviso" => "a")); ?>'> Adicionar</a>
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
                                    <th>Aluno</th>
                                    <th>Aviso</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                if (!$this->avisosEspecificos) {
                                    ?>
                                    <tr>
                                        <td colspan='3'><div class='alert alert-info'>Não há avisos especificos cadastrados</div></td>
                                    </tr>
                                    <?php
                                } else
                                    foreach ($this->avisosEspecificos as $aviso) {
                                        ?>
                                        <tr>
                                            <td><?php echo Encoding::utf8($aviso->quem()->Usuario_Nome); ?></td>
                                            <td><?php echo Encoding::utf8($aviso->aviso_aluno); ?></td>
                                            <td nowrap='nowrap'>
                                                <a  class='btn btn-info' href='<?php echo $this->url("professor", "avisos", "edit", array("id" => $aviso->getId())); ?>'>Editar</a>
                                                <a  class='btn btn-danger' href='<?php echo $this->url("professor", "avisos", "delete", array("id" => $aviso->getId())); ?>'>Excluir</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </section>
                <section class="panel">
                    <header class="panel-heading">
                        Avisos para módulos <a class='btn btn-success' href='<?php echo $this->url("professor", "avisos", "add", array("aviso" => "m")); ?>'>Adicionar</a>
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <table class='table table-striped table-bordered'>
                            <theader>
                                <tr>
                                    <th>Módulo</th>
                                    <th>Aviso</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                if (!$this->avisosModulos) {
                                    ?>
                                    <tr>
                                        <td colspan='3'><div class='alert alert-info'>Não há avisos para módulos cadastrados</div></td>
                                    </tr>
                                    <?php
                                } else
                                    foreach ($this->avisosModulos as $aviso) {
                                        ?>
                                        <tr>
                                            <td><?php echo Encoding::utf8($aviso->quem()->Usuario_Nome); ?></td>
                                            <td><?php echo Encoding::utf8($aviso->aviso_aluno); ?></td>
                                            <td nowrap='nowrap'>
                                                <a  class='btn btn-info' href='<?php echo $this->url("professor", "avisos", "edit", array("id" => $aviso->getId())); ?>'>Editar</a>
                                                <a  class='btn btn-danger' href='<?php echo $this->url("professor", "avisos", "delete", array("id" => $aviso->getId())); ?>'>Excluir</a>
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

