<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2><?php echo Encoding::utf8($this->usuario->Usuario_Nome); ?> (<?php echo Encoding::utf8($this->usuario->cpf); ?>)</h2>  
    <p>Navegue através do menu a esquerda para acessar as opções do seu sistema</p>
    <div class='wrapper'>
        <div class='row'>

            <div class='col-xs-offset-2 col-md-offset-2 col-xs-8'>
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo Encoding::utf8($this->curso->titulo_curso); ?> 

                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <p><strong><?php echo Encoding::utf8($this->usuario->Usuario_Nome); ?> (<?php echo Encoding::utf8($this->usuario->cpf); ?>)</strong></p>
                        <br />
                        <table class='table table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Disciplina</th>
                                    <th>Carga</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($this->modulos as $modulo) {
                                    $ModelModulosData = new Model_ModulosData;
                                    $data = $ModelModulosData->getBymodulo($modulo->getId());

                                    $ModelModulosAutorizados = new Model_ModulosAutorizados;
                                    $autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis($this->usuarioCurso->codigo_aluno, $modulo->getId());

                                    if (!$autorizado) {
                                        $ModelModulosAutorizados = new Model_ModulosAutorizados;
                                        $ModelModulosAutorizados->codigo_aluno = $this->usuarioCurso->codigo_aluno;
                                        $ModelModulosAutorizados->iddis = $modulo->getId();
                                        $ModelModulosAutorizados->idmodata = $modulo->getId();
                                        $ModelModulosAutorizados->liberado = "N";
                                        $ModelModulosAutorizados->pagou = "N";
                                        $ModelModulosAutorizados->Usuario_DataCadastro = date("Y-m-d H:i:s");
                                        $ModelModulosAutorizados->codigo_prof = $modulo->codigo_professor;
                                        $ModelModulosAutorizados->salva();
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo Encoding::utf8($modulo->disciplina); ?>
                                        </td>
                                        <td>
                                            <span class='center-text'>
                                                <?php echo $modulo->carga; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($autorizado) echo $autorizado->nota; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>
                        <p>Conforme disposto: <br />
                            Parecer CEE-RJ nº 474 de 1994 <br />
                            Lei Estadual - RJ nº 3459/2000 <br /> 			
                            Decreto estadual - RJ 31086/2002 <br />
                        </p>                        

                    </div>

                </section>

            </div>
        </div>
    </div>
</div>

<style>
    .center-text {
        float:left;
        width: 100%;
        text-align: center;
    }
</style>
<?php
$this->getFooter();

