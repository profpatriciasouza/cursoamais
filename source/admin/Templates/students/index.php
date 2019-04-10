<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Alunos 
        <?php
        if (Security::get('tipo') != 'awersaw') {
            ?>
            <a class='btn btn-success' href='<?php echo $this->url('admin', 'students', 'add'); ?>'>Adicionar</a>
            <?php
        }
        ?>
    </h2>  

    <p>Veja todos os alunos cadastrados</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->

                    <section class="panel">
                        <header class="panel-heading">
                            Alunos
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">

                            <?php
                            Error::showAlerts()
                            ?>
                            <form method="GET" action="" class="form-inline">
                                <?php
                                $HTMLInput = new HTML_Input("filtro", "text", "filtro", "Buscar por");
                                $HTMLInput->value = @$_GET['filtro'];
                                $HTMLInput->build();
                                ?>
                                <button class="btn" type="submit">buscar</button>
                            </form>

                            <table class='table table-striped table-bordered'>
                                <theader>
                                    <tr>
                                        <th>Aluno</th>
                                        <th>Cursos</th>
                                        <th>Desconto</th>
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    if ($this->alunos)
                                        foreach ($this->alunos as $aluno) {
                                            $ModelCurso = new Model_Cursos;
                                            $produto = $ModelCurso->getById($aluno->Produto);
                                            ?>
                                            <tr>
                                                <td><?php echo Encoding::utf8($aluno->Usuario_Nome); ?> <br />
                                                    <small>Cadastrado: <?php echo date("d/m/Y", strtotime($aluno->Usuario_DataCadastro)) ?></small></td>
                                                <td>
                                                    <?php
                                                    if ($produto) {
                                                        ?>
                                                        <?php echo Encoding::utf8($produto->titulo_curso); ?> (<?php echo $produto->situacao; ?>)<br />
                                                        Validade: <?php
                                                        if ($aluno->Validade_Assinatura != "")
                                                            echo @date("d/m/Y", strtotime($aluno->Validade_Assinatura));
                                                        ?>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
        <?php echo $aluno->desconto; ?>%
                                                </td>
                                                <td nowrap='nowrap'>
                                                    <?php
                                                    if (Security::get('tipo') != 'awersaw') {
                                                        ?>
                                                                    <!--<a  class='btn btn-success' href='<?php echo $this->url(Map::$area, "students", "aprove", array("id" => $aluno->getId(), "curso" => $aluno->Produto)); ?>'>Aprovar</a>-->
                                                        <a  class='btn btn-info' href='<?php echo $this->url(Map::$area, "students", "edit", array("id" => $aluno->getId(), "curso" => $aluno->Produto)); ?>'>editar</a>
                                                        <a  class='btn btn-info' href='<?php echo $this->url(Map::$area, "students", "modulos", array("id" => $aluno->getId(), "curso" => $aluno->Produto)); ?>'>Cursos / Módulos</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a  class='btn btn-info' href='<?php echo $this->url(Map::$area, "students", "modulos", array("id" => $aluno->getId(), "curso" => $aluno->Produto)); ?>'>Lançar notas</a>
                                                        <?php
                                                    }
                                                    if (Security::get('tipo') != 'awersaw') {
                                                        ?>
                                                        <a  class='btn btn-info' href='<?php echo $this->url(Map::$area, "students", "historico", array("id" => $aluno->getId(), "curso" => $aluno->Produto)); ?>'>Histórico</a>
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
</div>
<?php
$this->getFooter();

