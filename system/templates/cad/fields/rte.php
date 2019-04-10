<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <textarea  name="<?= $this->fieldName ?>" id="<?= $id ?>"><?= $this->value ?></textarea>
    </div>
</div>
<?php
Plugins_Jquery::getRTE();
?>
<script type="text/javascript">
    $("#<?= $id ?>").rte({
        base_url: "<?= Plugins_Jquery::getRTEPath() ?>",
        frame_class: 'frameBody',
        width: <?= $this->is_set("rteWidth") && $this->rteWidth > 0 ? $this->rteWidth : 680; ?>,
        height: 150,
        controls_rte: rte_toolbar,
        controls_html: html_toolbar
    });
</script>