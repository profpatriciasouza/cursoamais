<?php
$this->getHeader();
?>
<div class="page-heading">
    <h3>
        Indicadores 
    </h3>
</div>
<div class="wrapper">
    <div class="col-lg-8">
        <form id="NovoProjeto" action="<?php echo $this->url('admin', 'index', "indicadores"); ?>" class="form-horizontal adminex-form" method="POST">
            <table class="table table-bordered table-condensed"> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Serviços</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->indicadores as $indicador) {
                        ?>
                        <tr>
                            <td><input type="hidden" name="row[Ordem][]" value="<?php echo $indicador->getId(); ?>" /><?php echo $indicador->getId(); ?></td>
                            <td><input type="text" class="form-control" name="row[Usuario_Nome][]" value="<?php echo Encoding::isUTF8($indicador->Usuario_Nome) ? $indicador->Usuario_Nome : Encoding::encode($indicador->Usuario_Nome); ?>" /></td>
                            <td><a class='btn btn-danger' href="<?php echo $this->url('admin', 'index', "indicadores"); ?>?excluir=<?php echo $indicador->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir este indicador?');"><i class="fa fa-times-circle"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td><input type="hidden" name="row[Ordem][]" value="novo" />Novo</td>
                        <td><input type="text" class="form-control" name="row[Usuario_Nome][]" value="" placeholder="Informe um novo serviço" /></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary">Salvar serviços</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$this->getFooter();
