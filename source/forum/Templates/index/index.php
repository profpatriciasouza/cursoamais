<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Fórum <?php
        if (Security::get('tipo') == 1 || Security::get('tipo') == 'awersaw') {
            ?>
            <a class="btn btn-info" href="<?php echo $this->url("forum", "manage", 'add'); ?>">Adicionar tópico</a>
            <?php
        }
        ?></h2>  
    <p>Tenha acesso a todo o conteúdo do curso.</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Fórum 
                            <?php
                            if (Security::get('tipo') == 1) {
                                ?>
                                <a class="btn btn-success" href="<?php echo $this->urlByAcao("add"); ?>">Adicionar</a>
                                <?php
                            }
                            ?>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>

                        </header>
                        <div class="panel-body">
                            <?php
                            Error::showAlerts();
                            ?>
                            <table class='table table-striped table-bordered'>
                                <theader>
                                    <tr>
                                        <th>Tópico</th>
                                        <th>Última mensagem</th>
                                        <th>Mensagens</th>
                                        <th></th>
                                    </tr>
                                </theader>
                                <tbody>
                                    <?php
                                    if ($this->topicos)
                                        foreach ($this->topicos as $topico) {
                                            ?>
                                            <tr>
                                                <td><? 
												
												//header('Content-Type: text/html; charset=iso-8859-1');
												
												echo Encoding::isUTF8($topico->Title) ? $topico->Title : utf8_encode($topico->Title); ?>
                                                <? //echo $topico->Title; ?>
                                               
                                                <br />
                                                <small><strong>Curso:</strong> <?php if($topico->modulo()->curso()) echo Encoding::utf8($topico->modulo()->curso()->titulo_curso); ?> </small><br />
                                                <small><strong>Módulo:</strong> <?php echo Encoding::utf8($topico->modulo()->disciplina); ?> </small>
                                                
                                                </td>
                                                <td><?php echo date("d/m/Y", strtotime($topico->TheDate)); ?><br /><small>por <?php echo Encoding::utf8($topico->Author); ?></small></td>
                                                <td><?php echo count($topico->comentarios()) ?></td>
                                                <td>
                                                    <a  class='btn btn-info' href='<?php echo $this->url(Map::$area, "topic", array("id" => $topico->getId())); ?>'><i class='fa fa-play-circle-o'></i> Acessar</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>

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

