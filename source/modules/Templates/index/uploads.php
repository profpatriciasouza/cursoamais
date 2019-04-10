<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Uploads</h2>  
    <p>Veja os arquivos enviados pelos alunos </p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <section class="panel">
                    <header class="panel-heading">
                        Arquivos
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
                                    <th>Arquivo</th>
                                    <th>Data Envio</th>
                                    <th></th>
                                </tr>
                            </theader>
                            <tbody>
                                <?php
                                if ($this->modulo->hasArquivos())
                                    foreach ($this->modulo->arquivos() as $arquivo) {
                                        if (!$arquivo->aluno())
                                            continue;
                                        ?>
                                        <tr>
                                            <td><?php echo Encoding::utf8($arquivo->aluno()->Usuario_Nome); ?></td>
                                            <td><?php echo $arquivo->arquivo; ?></td>
                                            <td><?php echo $arquivo->data; ?> <?php echo $arquivo->hora; ?></td>
                                            <td>
                                                <a target="_blank" class='btn btn-danger' href='/uploads/<?php echo $arquivo->arquivo; ?>'>Download</a>

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

