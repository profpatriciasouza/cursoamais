<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Correio</h2>  
    <p>Veja todas as mensagens.</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <?php
                    Error::showAlerts();
                    ?>
                    <div class='row'>

                        <div class='col-xs-3'>
                            <ul class="nav  nav-pills nav-stacked"  role="tablist">
                                <li role="presentation" class="active"><a href="#entrada" aria-controls="entrada" role="tab" data-toggle="tab">Entrada</a></li>
                                <li role="presentation"><a href="#enviadas" aria-controls="enviadas" role="tab" data-toggle="tab">Enviadas</a></li>
                                <li role="presentation"><a href="#enviar" aria-controls="enviar" role="tab" data-toggle="tab">Enviar</a></li>
                            </ul>
                        </div>
                        <div class="tab-content col-xs-9">

                            <div role="tabpanel" class="tab-pane col-xs-12" id="enviadas">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <i class='fa fa-wechat'></i> Enviadas
                                        <span class="tools pull-right">
                                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body" style="max-height: 300px; overflow: hidden; overflow-y: auto;  display: block;">
                                        <?php
                                        if (!$this->enviadas) {
                                            
                                        } else {
                                            foreach ($this->enviadas as $enviada) {
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <span><strong><?php echo Encoding::utf8($enviada->assunto); ?></strong></span>
                                                        <br />
                                                        <span style="color: #999999; font-size: 11px;"><?php echo date("d/m/Y H:i", strtotime($enviada->data_mensagem)); ?></span> 
                                                        <span style="color: #999999; font-size: 11px;">Por: <?php echo $enviada->remetente; ?></span><br />
                                                        <?php echo Encoding::utf8($enviada->mensagem); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </section>
                            </div>

                            <div role="tabpanel" class="tab-pane active col-xs-12" id="entrada">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <i class='fa fa-quote-left'></i> Recebidas
                                        <span class="tools pull-right">
                                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body" style="max-height: 300px; overflow: hidden; overflow-y: auto;  display: block;">
                                        <?php
                                        if (!$this->mensagens) {
                                            ?>
                                            Suas mensagens recebidas
                                            <?php
                                        } else
                                            foreach ($this->mensagens as $mensagem) {
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <span><strong><?php echo Encoding::utf8($mensagem->assunto); ?></strong></span>
                                                        <a class="btn btn-info" href="<?php echo $this->urlByAcao("duvidas-responder", $mensagem->getId()); ?>">responder</a>
                                                        <br />
                                                        <span style="color: #999999; font-size: 11px;"><?php echo date("d/m/Y H:i", strtotime($mensagem->data_mensagem)); ?></span> 
                                                        <span style="color: #999999; font-size: 11px;">Por: <?php echo $mensagem->remetente; ?></span><br />
                                                        <?php echo Encoding::utf8($mensagem->mensagem); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </section>
                            </div>
                            <div role="tabpanel" class="tab-pane col-xs-12" id="enviar">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <i class='fa fa-download'></i> Enviar nova mensagem
                                        <span class="tools pull-right">
                                            <a class="fa fa-chevron-down" href="javascript:;"></a>

                                            <a class="fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body" style="">
                                        <form class="form-horizontal adminex-form" method="POST">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label col-lg-2">Destinatário</label>
                                                <div class="col-lg-10">
                                                    <div class="input-group m-bot15">
                                                        <span class="input-group-addon">@</span>
                                                        <input type="text" name='destinatario' class="form-control" readonly="readonly" placeholder="Username" value='<?php echo $this->modulo->professor()->Usuario_Email; ?>' >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Título</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name='assunto' class="form-control" placeholder="Informe o título do seu email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Mensagem</label>
                                                <div class="col-sm-10">
                                                    <textarea rows="6" name='mensagem' class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-10">
                                                    <button class='btn btn-success' type='submit'><i class='fa fa-send'></i> Enviar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <!--notification end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

