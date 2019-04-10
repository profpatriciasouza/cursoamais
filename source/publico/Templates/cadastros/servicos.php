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
        <li class="active"> Serviços </li>
    </ul>
</div>
<div class="wrapper">
    <div class="col-lg-8">
        <form id="NovoProjeto" action="<?php echo $this->url('cadastros', 'servicos'); ?>" class="form-horizontal adminex-form" method="POST">
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
                    foreach ($this->servicos as $servico) {
                        ?>
                        <tr>
                            <td><input type="hidden" name="servicos[ServicoId][]" value="<?php echo $servico->getId(); ?>" /><?php echo $servico->getId(); ?></td>
                            <td><input type="text" class="form-control" name="servicos[Servico][]" value="<?php echo $servico->Servico; ?>" /></td>
                            <td><a class='btn btn-danger' href="<?php echo $this->url('cadastros', 'servicos'); ?>?excluir=<?php echo $servico->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir este serviço?');"><i class="fa fa-times-circle"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td><input type="hidden" name="servicos[ServicoId][]" value="novo" />Novo</td>
                        <td><input type="text" class="form-control" name="servicos[Servico][]" value="" placeholder="Informe um novo serviço" /></td>
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
