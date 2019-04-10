<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Banners</h2>  
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->

                    <?php
                    Error::showAlerts();
                    ?>

                    <form method='POST' action="" enctype='multipart/form-data'>
                        <section class="panel">
                            <header class="panel-heading">
                                Formulário para banner
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                //pk_id_ban, ban_ds_name, ban_ds_description, ban_ds_path, ban_ds_url, ban_in_order, ban_in_views, ban_in_clicks
                                    
                                $HTMLInput = new HTML_Input("ban_ds_name", "text", "ban_ds_name", "Nome", "", true);
                                $HTMLInput->value = Encoding::utf8($this->banner->ban_ds_name);
                                $HTMLInput->build();


                                $HTMLInput = new HTML_Input("ban_ds_description", "textarea", "ban_ds_description", "Descrição", "", true);
                                $HTMLInput->value = Encoding::utf8($this->banner->ban_ds_description);
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("ban_ds_path", "file", "ban_ds_path", "Banner", "", true);
                                $HTMLInput->value = Encoding::utf8($this->banner->ban_ds_path);
                                $HTMLInput->build();
                                    
                                $HTMLInput = new HTML_Input("ban_ds_url", "text", "ban_ds_url", "URL", "", true);
                                $HTMLInput->value = Encoding::utf8($this->banner->ban_ds_url);
                                $HTMLInput->build();
                                    
                                $HTMLInput = new HTML_Input("ban_in_order", "text", "ban_in_order", "Posição", "", true);
                                $HTMLInput->value = Encoding::utf8($this->banner->ban_in_order);
                                $HTMLInput->build();
                                ?>

                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>


                    </form>


                    <!--notification end-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

