<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Banners
        <a class="btn btn-success" href="<?php echo $this->urlByAcao("add"); ?>">Adicionar</a>
    </h2>  
    <p>Administre todos os banners da Home do site.</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Banners 

                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>

                        </header>
                        <div class="panel-body">
                            <?php
                            Error::showAlerts();
                            ?>
                            <form method="POST" action="<?php echo $this->urlByAcao("edit-order"); ?>">
                                <table class='table table-striped table-bordered'>
                                    <theader>
                                        <tr>
                                            <th>Imagem</th>
                                            <th>URL</th>
                                            <th>Dados</th>
                                            <th>Ordem</th>
                                            <th></th>
                                        </tr>
                                    </theader>
                                    <tbody>
                                        <?php
                                        if (!$this->banners) {
                                            ?>
                                            <tr>
                                                <td colspan="5"><div class='alert alert-danger'>Não há banners para serem exibidos no momento</div></td>
                                            </tr>
                                            <?php
                                        } else 
                                            foreach ($this->banners as $banner) {
                                                ?>
                                                <tr>
                                                    <td width='10%'><img src='/uploads/<?php echo $banner->ban_ds_path ?>' class='img-responsive' /></td>
                                                    <td><a class='btn btn-info' href='<?php echo $banner->ban_ds_url ?>' target='_blank'>ver link</a></td>
                                                    <td><?php echo $banner->ban_ds_name ?><br /><small><?php echo $banner->ban_ds_description ?></small></td>
                                                    <td width='10%'><input type='text' class='form-control' name='banner[<?php echo $banner->pk_id_ban; ?>]' value='<?php echo $banner->ban_in_order; ?>' /></td>
                                                    <td>
                                                        <a  class='btn btn-info' href='<?php echo $this->urlByAcao("edit", $banner->getId()); ?>'><i class='fa fa-edit'></i> editar</a>
                                                        <a  class='btn btn-danger' href='<?php echo $this->urlByAcao("delete", $banner->getId()); ?>'><i class='fa fa-times'></i> excluir</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan='4'></td>
                                            <td ><button class='btn btn-success' type='submit'>Salvar ordem</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
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

