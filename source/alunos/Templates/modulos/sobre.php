<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Conteúdo</h2>  
    <p>Tenha acesso a todo o conteúdo do curso.</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Conteúdo do curso
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>

                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <?php
                            echo nl2br(Encoding::utf8($this->modulo->conteudo));
                            ?>

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

