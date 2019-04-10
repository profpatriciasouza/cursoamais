<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <input type="text"  name="<?= $this->fieldName ?>" id="<?= $id ?>" value="<?= $this->value ?>" placeholder="<?= $this->Placeholder ?>">
    </div>
</div>
<?php
if ($this->Mask!="") {
    Plugins_Jquery::getInputMask();
}
?>
<script type="text/javascript">
    
<?php
if ($this->Mask!="") {
    ?>
            $("#<?= $id ?>").mask("<?= $this->Mask; ?>");    
    <?php
}

if ($this->is_set("inputWidth")) {
    ?>
            $("#f<?= $id ?> .input").css("width", "<?= $this->inputWidth ?>");
    <?php
}
?>
</script>