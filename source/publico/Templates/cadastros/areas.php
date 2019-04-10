<?php
$this->getHeader();
?>
<div class="page-heading">
    <h3>
        Novo Projeto
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="/sac/">KPZ Valor</a>
        </li>
        <li>
            <a href="/sac/projetos">Projetos</a>
        </li>
        <li class="active"> Áreas </li>
    </ul>
</div>
<div class="wrapper">
    <div class="col-lg-8">
        <form id="NovoProjeto" action="<?php echo $this->url('cadastros', 'areas'); ?>" class="form-horizontal adminex-form" method="POST">
            <table class="table table-bordered table-condensed"> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Área</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->areas as $area) {
                        ?>
                        <tr>
                            <td><input type="hidden" name="areas[AreaId][]" value="<?php echo $area->getId(); ?>" /><?php echo $area->getId(); ?></td>
                            <td><input type="text" class="form-control" name="areas[Area][]" value="<?php echo $area->Area; ?>" /></td>
                            <td><a class='btn btn-danger' href="<?php echo $this->url('cadastros', 'areas'); ?>?excluir=<?php echo $area->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta área?');"><i class="fa fa-times-circle"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td><input type="hidden" name="areas[AreaId][]" value="novo" />Novo</td>
                        <td><input type="text" class="form-control" name="areas[Area][]" value="" placeholder="Informe um novo serviço" /></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary">Salvar área</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$this->getFooter();
