<?php
$this->getHeader();
?>
<div class="page-heading">
    <h3>
        Administradores 
    </h3>
</div>
<div class="wrapper">
    <div class="col-lg-8">
        <form id="NovoProjeto" action="<?php echo $this->url('admin', 'index', "senha"); ?>" class="form-horizontal adminex-form" method="POST">
            <table class="table table-bordered table-condensed"> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Senha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->senhas as $senha) {
                        ?>
                        <tr>
                            <td><input type="hidden" name="row[ID][]" value="<?php echo $senha->getId(); ?>" /><?php echo $senha->getId(); ?></td>
                            <td><input type="text" class="form-control" name="row[NOME][]" value="<?php echo Encoding::utf8($senha->NOME); ?>" /></td>
                            <td><input type="text" class="form-control" name="row[LOGIN][]" value="<?php echo Encoding::utf8($senha->LOGIN); ?>" /></td>
                            <td><input type="text" class="form-control" name="row[SENHA][]" value="<?php echo Encoding::utf8($senha->SENHA); ?>" /></td>
                            <td><a class='btn btn-danger' href="<?php echo $this->url('admin', 'index', "senha"); ?>?excluir=<?php echo $senha->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir este administrador?');"><i class="fa fa-times-circle"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <tr>
                            <td><input type="hidden" name="row[ID][]" value="novo" /></td>
                            <td><input type="text" class="form-control" name="row[NOME][]" value="" /></td>
                            <td><input type="text" class="form-control" name="row[LOGIN][]" value="" /></td>
                            <td><input type="text" class="form-control" name="row[SENHA][]" value="" /></td>
                            <td></td>
                        </tr>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$this->getFooter();
