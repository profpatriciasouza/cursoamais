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
                            Arquivos
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <table class='table table-striped table-bordered'>
                                <theader>
                                    <tr>
                                        <th>Arquivo</th>
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    if (!$this->uploads) {
                                        ?>
                                        <tr>
                                            <td colspan='8'>Nenhum arquivo enviado por este aluno</td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($this->uploads as $upload) {
                                            ?>
                                            <tr>
                                                <td><?php echo $upload->arquivo; ?></td>
                                                <td>
                                                    <a class="btn btn-info" target="_blank" href="<?php echo System_CONFIG::get('upload_url') ?><?php echo $upload->arquivo; ?>">Download</a>
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

