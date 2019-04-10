<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Notícia</h2>  
    <p>Veja todas as notícias cadastradas no seu noticia</p>
    <div class='wrapper'>
        <div class='row'>

            <div class="col-md-12">
                <!--notification start-->
                <?php
                if ($this->noticias)
                    foreach ($this->noticias as $noticia) {
                        ?>
                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo $noticia->titulo; ?>
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">

                                <?php echo $noticia->mensagem; ?>
                                <br />
                                <small><strong>Enviado:</strong> <?php echo date("d/m/Y H:i", strtotime($noticia->data)); ?></small>
                            </div>
                        </section>
                        <?php
                    }
                ?>
                <!--notification end-->
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

