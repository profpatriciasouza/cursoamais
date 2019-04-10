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
                            Notas para o curso: <?php echo Encoding::utf8($this->curso->titulo_curso); ?>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>

                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">


                            <table class='table table-bordered table-striped '>
                                <tbody><tr class="style7" align="center" bgcolor="#C0C0C0">
                                        <td colspan="2" class="style2">Módulo</td>
                                        <td class="style2"> Nota</td>
                                    </tr>
                                    <?php
                                    foreach ($this->modulos as $modulo) {
                                        $ModelModulosData = new Model_ModulosData;
                                        $data = $ModelModulosData->getBymodulo($modulo->getId());

                                        $ModelModulosAutorizados = new Model_ModulosAutorizados;
                                        $autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $modulo->getId());
                                        ?>
                                        <tr class="style5" bgcolor="#F3F3F3">
                                            <td colspan="2" bgcolor="#F3F3F3"><div align="left">
                                                    <?php echo Encoding::utf8($modulo->disciplina); ?>
                                                </div></td>
                                                <td><?php echo $autorizado->nota?></td>
                                            <?php
                                        }
                                        ?>
                                   
                                </tbody></table>

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

