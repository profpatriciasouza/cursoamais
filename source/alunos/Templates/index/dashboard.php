<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Área do aluno</h2>  
    <p>Navegue através do menu a esquerda para acessar as opções do seu sistema</p>
    <div class='wrapper'>
        <div class='row'>

            <?php
            foreach ($this->usuarioCurso as $uc) {


                $ModelCursos = new Model_Cursos;
                $this->curso = $ModelCursos->getById($uc->Produto);

                $ModelModulos = new Model_Modulos;
                $ModelModulos->orderby("posicao ASC");
                $this->modulos = $ModelModulos->getAllBycurso($uc->Produto);
                ?>

                <div class='col-xs-offset-1 col-md-offset-1 col-xs-10'>
                    <section class="panel">
                        <header class="panel-heading">
                            <?php echo Encoding::utf8($this->curso->titulo_curso); ?> <br /> 

                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--<p class="center">Início do Curso 21/08/2015 15:07:33 Último Acesso em 16/11/2015 07:56:52</p>-->
                            <table class='table table table-striped table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Módulo</th>
                                        <th>Calendário</th>
                                        <th>Nota</th>
                                        <th>Pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $parcela = 1;
                                    if ($this->modulos)
                                        foreach ($this->modulos as $modulo) {
                                            $ModelModulosData = new Model_ModulosData;
                                            $data = $ModelModulosData->getBymodulo($modulo->getId());

                                            $ModelModulosAutorizados = new Model_ModulosAutorizados;
                                            $autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $modulo->getId());

                                            if (!$autorizado) {
                                                $ModelModulosAutorizados = new Model_ModulosAutorizados;
                                                $ModelModulosAutorizados->codigo_aluno = Security::get("codigo_aluno");
                                                $ModelModulosAutorizados->iddis = $modulo->getId();
                                                $ModelModulosAutorizados->idmodata = $modulo->getId();
                                                $ModelModulosAutorizados->liberado = "N";
                                                $ModelModulosAutorizados->pagou = "N";
                                                $ModelModulosAutorizados->Usuario_DataCadastro = date("Y-m-d H:i:s");
                                                $ModelModulosAutorizados->codigo_prof = $modulo->codigo_professor;
                                                $ModelModulosAutorizados->salva();

                                                $autorizado = $ModelModulosAutorizados->getBycodigo_aluno__iddis(Security::get("codigo_aluno"), $modulo->getId());
                                            }
                                            ?>
                                            <tr>
                                                <td class='big'>
                                                    <i class='fa fa-book'></i> <?php echo Encoding::utf8($modulo->disciplina); ?>
                                                </td>
                                                <td nowrap="nowrap">

                                                    <button type="button" class="btn btn-sm pull-right btn-primary btn-lg" data-toggle="modal" data-target="#myModal<?php echo $modulo->getId(); ?>">
                                                        <i class='fa fa-calendar'></i>
                                                    </button>
                                                    <?php
                                                    if ($data) {
                                                        /* if (time() > strtotime($data->inicio) && time() < strtotime($data->fim)) {
                                                          ?>
                                                          Não liberado
                                                          <?php
                                                          } *///else if ($autorizado->nota < 7) {
                                                        ?>
                                                        <?php
                                                        echo "de  " . date("d/m/Y", strtotime($data->inicio));
                                                        echo " até  " . date("d/m/Y", strtotime($data->fim));
                                                        //}
                                                    }
                                                    ?> 
                                                    <div class="modal fade" id="myModal<?php echo $modulo->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Calendário de <?php echo Encoding::utf8($modulo->disciplina); ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong>Liberação do módulo: </strong>
                                                                    <?php
                                                                    if ($data) {
                                                                        /* if (time() > strtotime($data->inicio) && time() < strtotime($data->fim)) {
                                                                          ?>
                                                                          Não liberado
                                                                          <?php
                                                                          } *///else if ($autorizado->nota < 7) {
                                                                        ?>
                                                                        <?php
                                                                        echo "de  " . date("d/m/Y", strtotime($data->inicio));
                                                                        echo " até  " . date("d/m/Y", strtotime($data->fim));
                                                                        //}
                                                                    }
                                                                    ?>  <br />
                                                                    <br />
                                                                    <strong>Período para tirar dúvidas:</strong> 
                                                                    <?php
                                                                    if ($data) {
                                                                        /* if (time() > strtotime($data->inicio) && time() < strtotime($data->fim)) {
                                                                          ?>
                                                                          Não liberado
                                                                          <?php
                                                                          } *///else if ($autorizado->nota < 7) {
                                                                        ?>
                                                                        <?php
                                                                        echo "de  " . date("d/m/Y", strtotime($data->duvidas_de));
                                                                        echo " até  " . date("d/m/Y", strtotime($data->duvidas_a));
                                                                        //}
                                                                    }
                                                                    ?>   <br />
                                                                    <br />
                                                                    <strong>Data limite para entrega do trabalho:</strong>
                                                                    <?php
                                                                    if ($data) {
                                                                        /* if (time() > strtotime($data->inicio) && time() < strtotime($data->fim)) {
                                                                          ?>
                                                                          Não liberado
                                                                          <?php
                                                                          } *///else if ($autorizado->nota < 7) {
                                                                        ?>
                                                                        <?php
                                                                        echo "até " . date("d/m/Y", strtotime($data->entrega_ate));
                                                                        //}
                                                                    }
                                                                    ?> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $autorizado->nota; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($autorizado) {
                                                        if ($autorizado->liberado == "S" || $modulo->valor == 0) {
                                                            ?>
                                                            <a href='<?php echo $this->url("alunos", "modulos", "seleciona", array("id" => $modulo->getId())); ?>' class='btn btn-info'><i class='fa fa-play'></i> Acessar</a>
                                                            <?php
                                                        } else {
                                                            if ($autorizado->nota >= 7) {
                                                                echo "APROVADO";
                                                            } else {
                                                                ?>
                                                                <a class="btn btn-success"  target="_blank" href="/prgravapagseguro.asp?parcela=<?php echo $parcela ?>&amp;id=<?php echo $modulo->id; ?>&amp;Ordem=<?php echo Security::get('Ordem'); ?>&amp;ca=<?php echo Security::get('codigo_aluno'); ?>"><i class="fa fa-barcode"></i> PAGAR</a>
                                                                <?php
                                                            }
                                                        }
                                                    } else {
                                                        
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php
                                            $anterior = $autorizado->nota;
                                            $parcela++;
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                    </section>

                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
$this->getFooter();


