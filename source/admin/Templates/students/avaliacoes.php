<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2><?php echo $this->aluno->Usuario_Nome; ?></h2>  
    <p>Tenha acesso a todo o conteúdo do curso.</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Avaliações
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <table class='table table-striped table-bordered'>
                                <theader>
                                    <tr>
                                        <th>Avaliação</th>
                                        <th>Status</th>
                                        <th>Nota</th>
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    if (!$this->avaliacoes) {
                                        ?>
                                        <tr>
                                            <td colspan='8'>Nenhum arquivo enviado por este aluno</td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($this->avaliacoes as $avaliacao) {
                                            ?>
                                            <tr>
                                                <td><?php echo $avaliacao->ava_ds_name; ?></td>
                                                <td><?php echo $this->autorizado->status($avaliacao->getId()); ?></td>
                                                <td><?php echo $this->autorizado->nota($avaliacao->getId()); ?></td>
                                                <td>
                                                    <a class="btn btn-info" href="<?php echo $this->url('admin', 'students', 'ver-avaliacao', array('avaliacao' => $avaliacao->getId(), 'autorizado' => $this->autorizado->getId())) ;?>" target="_blank">ver</a>
                                                    <a class="btn btn-danger btn-ajax" href="<?php echo $this->url('admin', 'students', 'refazer-avaliacao', array('avaliacao' => $avaliacao->getId(), 'autorizado' => $this->autorizado->getId())) ;?>">Permitir refazer</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class='form-group'>
                                <br />
                                <button type="submit" class="btn btn-primary">Salvar tudo</button>
                            </div>

                            </form>
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

