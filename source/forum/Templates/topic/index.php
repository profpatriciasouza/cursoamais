<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2><?php echo Encoding::utf8($this->topico->Title); ?><?php
        if (Security::get('tipo') == 1 || Security::get('tipo') == 'awersaw') {
            ?>
            <a class="btn btn-info" href="<?php echo $this->url("forum", "manage", 'edit', array("id" => $this->topico->getId())); ?>">editar</a>
            <?php
            if (Security::get('tipo') == 1) {
                ?>
                <a class="btn btn-danger" href="<?php echo $this->url("forum", "manage", 'delete', array("id" => $this->topico->getId())); ?>">excluír fórum</a>
                <?php
            }
        }
        ?></h2>  
    <p>Veja toda a conversa sobre este tópico</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <?php
                    Error::showAlerts();
                    ?>

                    <div class="col-md-12">
                        <div class="panel">
                            <header class="panel-heading">
                                Discussões
                            </header>
                            <div class="panel-body">
                                <div class="col-xs-8">
                                    <ul class="chats normal-chat" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                                        <li class="in">
                                            <div class="message ">
                                                <span class="arrow"></span>
                                                <a class="name" href="#"><?php echo $this->topico->Author; ?></a>
                                                <span class="datetime"><?php echo date("d/m/Y H:i:s", strtotime($this->topico->TheDate)); ?></span>
                                                <span class="body">
                                                    <?php echo Encoding::utf8($this->topico->Body); ?>

                                                </span>
                                            </div>
                                        </li>
                                        <?php
                                        $comentarios = $this->topico->comentarios();
                                        foreach ($comentarios as $k => $comentario) {
                                            if ($k % 2 == 0) {
                                                ?>
                                                <li class="out">
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a class="name" href="#"><?php echo Encoding::utf8($comentario->Author); ?></a>
                                                        <span class="datetime"><?php echo date("d/m/Y H:i:s", strtotime($comentario->TheDate)); ?></span>
                                                        <span class="body">
                                                            <?php echo nl2br(Encoding::utf8($comentario->Body)); ?>
                                                        </span>
                                                    </div>
                                                </li>
                                                <?php
                                            } else {
                                                ?>
                                                <li class="in">
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a class="name" href="#"><?php echo Encoding::utf8($comentario->Author); ?></a>
                                                        <span class="datetime"><?php echo date("d/m/Y H:i:s", strtotime($comentario->TheDate)); ?></span>
                                                        <span class="body">
                                                            <?php echo nl2br(Encoding::utf8($comentario->Body)); ?>
                                                        </span>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="col-xs-4">
                                    <div class="chat-form ">
                                        <form method="POST" action="" role="form">
                                            <?php
                                            $HTMLInput = new HTML_Input("Mensagem", "textarea", "Mensagem", "Enviar nova mensagem", "", true);
                                            $HTMLInput->rows = 5;
                                            $HTMLInput->build();
                                            ?>
                                            <button class="btn btn-primary" type="submit">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!--notification end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->getFooter();

