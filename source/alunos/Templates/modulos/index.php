<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Área do aluno</h2>  
    <p>Aqui você pode baixar todo o conteúdo disponível. Navegue no menu esquerdo para acessar as outras áreas deste módulo</p>
    <div class='wrapper'>
        <div class='row'>
            <div class='row'>
                
                    <div class="col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <i class='fa fa-exclamation-triangle'></i> Avisos
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>

                                    <a class="fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body" style="display: block;">
                                <?php
                if ($this->avisos) {
                    ?>
                                <?php
                                foreach ($this->avisos as $aviso) {
                                    ?>
                                    <div class="alert alert-info">
                                        <?php echo $aviso->aviso_aluno; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                    <?php
                } else {
                ?>
                                <div class="alert alert-info">Não há nenhum aviso para você!</div>
                    <?php
                }
                ?>
                            </div>
                        </section>
                    </div>



                <div class='col-xs-8'>
                    <section class="panel">
                        <header class="panel-heading">
                            <i class='fa fa-wechat'></i> Fórum
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>

                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body" style="display: block;">
                            <?php
                            if ($this->feedbacks) {
                                ?>
                                <table class='table table-striped table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Mensagem</th>
                                            <th>Autor</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($this->feedbacks as $feedback) {
                                            ?>
                                            <tr>
                                                <td><?php echo Encoding::utf8($feedback->Title); ?></td>
                                                <td><?php echo $feedback->Author ?></td>
                                                <td>
                                                    <a  class='btn btn-info' href='<?php echo $this->url("forum", "topic", array("id" => $feedback->getId())); ?>'><i class='fa fa-play-circle-o'></i> Acessar</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                ?>
                                <div class='alert alert-info'>Não há nenhuma mensagem no fórum</div>
                                <?php
                            }
                            ?>

                        </div>
                    </section>
                </div>

                <div class='col-xs-4'>
                    <section class="panel">
                        <header class="panel-heading">
                            <i class='fa fa-quote-left'></i> Sua foto
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body" style="display: block;">
                            <form style="<?php
                            if (Security::get('foto') != "") {
                                echo 'display:none;';
                            }
                            ?>" method="POST" action="<?php echo $this->urlByAcao("foto"); ?>" enctype="multipart/form-data">
                                      <?php
                                      $HTMLInput = new HTML_Input("foto", "file", "foto", "Atualize sua foto", "");
                                      $HTMLInput->build();
                                      ?>
                                <br />
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Salvar</button>
                                </div>

                            </form>
                            <?php
                            if (Security::get('foto') != "") {
                                ?>
                                <img class="img-responsive" src="/uploads/<?php echo Security::get('foto'); ?>">
                                <br />
                                <div class="pull-right">
                                    <button class="btn btn-edit-foto  btn-primary" type="button">editar</button>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-heading">
                            <i class='fa fa-quote-left'></i> Mural
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>

                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body" style="display: block;">
                            <?php
                            if ($this->murais) {
                                ?>
                                <table class='table table-striped table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Mensagem</th>
                                            <th>Autor</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($this->murais as $mural) {
                                            ?>
                                            <tr>
                                                <td><?php echo $mural->id ?></td>
                                                <td><?php echo $mural->mensagem ?></td>
                                                <td><a class='btn' ><i class='fa fa-play'></i> acessar</a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                ?>
                                <div class='alert alert-info'>Não há nenhuma mensagem no mural</div>
                                <?php
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
            <div class='col-xs-6'>
                <section class="panel">
                    <header class="panel-heading">
                        <i class='fa fa-download'></i> Matérias
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-up" href="javascript:;"></a>

                            <a class="fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="display: none;">
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
            </div>
            <div class='col-xs-6'>
                <section class="panel">
                    <header class="panel-heading">
                        <i class='fa fa-globe'></i> Apostilas Virtuais
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-up" href="javascript:;"></a>

                            <a class="fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="display: none;">
                        <ul class="lista-materias">
                            <?php
                            for ($i = 1; $i <= 3; $i++) {
                                $titulo = "link" . $i;
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
            </div><div class='col-xs-6'>
                <section class="panel">
                    <header class="panel-heading">
                        <i class='fa fa-play'></i> Vídeos
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-up" href="javascript:;"></a>

                            <a class="fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="display: none;">
                        <ul class="lista-materias">
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                $titulo = "video" . $i;
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
            </div>
            <div class='col-xs-6'>
                <section class="panel">
                    <header class="panel-heading">
                        <i class='fa fa-pencil'></i> Atividades
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-up" href="javascript:;"></a>

                            <a class="fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="display: none;">
                        <ul class="lista-materias">
                            <?php
                            for ($i = 1; $i <= 3; $i++) {
                                $titulo = "exercicio" . $i;
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
            </div>


        </div>
    </div>
</div>
<?php
$this->getFooter();

