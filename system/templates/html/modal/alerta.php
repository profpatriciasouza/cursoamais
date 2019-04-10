<div id="<?php echo $this->id; ?>" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $this->titulo; ?></h4>
        </div>
        <div class="modal-body" id="utility_body">
            <?php
            Error::showAlerts();

            echo $this->msg;
            ?>
        </div>
        <div class="modal-footer">
            <?php
            echo $this->btnSair->build();
            ?>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php
$this->loadAssets('css');
$this->loadAssets('js');
?>