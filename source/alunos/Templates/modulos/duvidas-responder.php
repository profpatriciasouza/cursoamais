<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Correio</h2>  
    <p>Responda a mensagem.</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->
                    <div class='col-xs-12'>
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
                                                <input type="text" class="form-control" name="destinatario" value="<?php echo $this->mensagen->remetente; ?>" placeholder="Informe o remetente">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Título</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="assunto" value="Re: <?php echo Encoding::utf8($this->mensagen->assunto); ?>" placeholder="Informe o assunto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mensagem</label>
                                        <div class="col-sm-10">
                                            <textarea rows="6" name='mensagem' class="form-control">


----
<?php echo Encoding::utf8($this->mensagen->mensagem); ?>
                                            </textarea>
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

                    <!--notification end-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

