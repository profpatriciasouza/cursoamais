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
                            Matérias
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>

                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">

                            <ul class="lista-materias">
                                <?php
                            for ($i = 1; $i <= 10; $i++) {
                                $titulo = "materia" . $i;
                                if ($this->modulo->$titulo != "") {
                                    ?>
                                    <li><a href="/uploads/<?php echo $this->modulo->$titulo ?>"><i class="fa fa-download"></i> <?php echo Encoding::utf8($this->modulo->$titulo) ?></a>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>

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

