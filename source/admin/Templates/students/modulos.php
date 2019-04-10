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
                            Secretário
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <?php
                            Error::showAlerts();
                            ?>


                            <form method='POST' action="" enctype='multipart/form-data'>

                                <?php
                                //var_dump($this->cursos);

                                $HTMLInput = new HTML_Input("aprovado", "checkbox", "aprovado", "Aprovado?");
                                if ($this->cursos->academico)
                                    $HTMLInput->checked = $this->cursos->academico == 'A';
                                $HTMLInput->build();

                                $HTMLInput = new HTML_Input("ativo", "checkbox", "ativo", "Ativo?");
                                if ($this->cursos->situacao)
                                    $HTMLInput->checked = $this->cursos->situacao == 'S';
                                if (Security::get('tipo') != 'awersaw')
                                    $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("Validade_Assinatura", "data", "Validade_Assinatura", "Data de validade", "", true);
                                if ($this->cursos->Validade_Assinatura != "")
                                    @$HTMLInput->value = date("d/m/Y", strtotime($this->cursos->Validade_Assinatura));
                                if (Security::get('tipo') != 'awersaw')
                                    $HTMLInput->build();
                                ?>


                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>

                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-heading">
                            Módulos
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <table class='table table-striped table-bordered'>
                                <theader>
                                    <tr>
                                        <th>Módulo</th>
                                        <?php
                                        if (Security::get('tipo') != 'awersaw') {
                                            ?>
                                            <th>Liberado</th>
                                            <th>Pagou</th>
                                            <th>Aprovado</th>
                                            <?php
                                        }
                                        ?>
                                        <th>Nota</th>
                                        <!--<th>Login no parceiro</th>
                                        <th>Senha no parceiro</th>-->
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    if (!$this->modulos) {
                                        ?>
                                        <tr>
                                            <td colspan='8'>Não há módulos para este aluno</td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($this->modulos as $modulo) {
                                            $autorizado = $modulo->autorizado($this->aluno->codigo_aluno);
                                            //var_dump($autorizado->id);
                                            if (!$autorizado) {

                                                //, usuario_datacadastro, iddis, codigo_aluno
                                                $ModelModulosAutorizados = new Model_ModulosAutorizados();
                                                $ModelModulosAutorizados->codigo_prof = $modulo->codigo_professor;
                                                $ModelModulosAutorizados->usuario_datacadastro = date("Y-m-d H:i:s");
                                                $ModelModulosAutorizados->iddis = $modulo->id;
                                                $ModelModulosAutorizados->codigo_aluno = $this->aluno->codigo_aluno;

                                                $ModelModulosAutorizados->salva();

                                                $autorizado = $modulo->autorizado($this->aluno->codigo_aluno);
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo Encoding::isUTF8($modulo->disciplina) ? $modulo->disciplina : utf8_encode($modulo->disciplina) ?></td>
                                                <?php
                                                if (Security::get('tipo') != 'awersaw') {
                                                    ?>
                                                    <td><input type="checkbox" 
                                                        <?php echo $autorizado->liberado == "S" ? "checked" : "" ?> 
                                                               name='liberado[<?php echo $autorizado->id; ?>]' 
                                                               value ='S' /></td>
                                                    <td><input type="checkbox" <?php echo $autorizado->pagou == "S" ? "checked" : "" ?> 
                                                               name='pagou[<?php echo $autorizado->id; ?>]' 
                                                               value ='S' /></td>
                                                    <td><input type="checkbox" <?php echo $autorizado->academico == "A" ? "checked" : "" ?> 
                                                               name='academico[<?php echo $autorizado->id; ?>]' 
                                                               value ='S' /></td>
                                                        <?php
                                                    }
                                                    ?>
                                                <td><input type="text" name='nota[<?php echo $autorizado->id; ?>]' value='<?php echo $autorizado->nota; ?>' /></td>
                                                <!--<td><input type="text" name='loginparceiro[<?php echo $this->cursos->Id; ?>]' values='<?php echo $this->cursos->loginparceiro ?>' /></td>
                                                <td><input type="text" name='senhaparceiro[<?php echo $this->cursos->Id; ?>]' values='<?php echo $this->cursos->senhaparceiro ?>' /></td>-->
                                                <td>
                                                    <a class="btn btn-info" target="_blank" href="<?php echo $this->url('admin', 'students', 'arquivos', array('id' => Map::get('id'), 'curso' => Map::get('curso'), 'module' => $modulo->getId(), 'ca' => $this->aluno->codigo_aluno)); ?>">Arquivos (<?php echo $this->aluno->curso()->countUploads($modulo->getId()); ?>)</a>
                                                    <a class="btn btn-info" target="_blank" href="<?php echo $this->url('admin', 'students', 'avaliacoes', array('id' => Map::get('id'), 'curso' => Map::get('curso'), 'module' => $modulo->getId(), 'ca' => $this->aluno->codigo_aluno)); ?>">Avaliações</a>
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

