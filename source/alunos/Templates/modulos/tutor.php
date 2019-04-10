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
                            Tutor: <?php echo Encoding::utf8($this->professor->Usuario_Nome); ?>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>

                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <br>FORMAÇÃO ACADÊMICA:<br>
                           <?php echo nl2br(Encoding::utf8($this->professor->curriculo)); ?>

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

