<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="f">
    <label><?=$this->Label; ?>:</label>
    <div class="input hora" style="margin-left: 0px;">
        <input type="text" name="<?=preg_replace("/[^0-9A-Za-z]/", "", $this->fieldName)?>Hora<?=preg_match("/\[/", $this->fieldName) ? "[]" : ""?>" id="<?=preg_replace("/[^0-9A-Za-z]/", "", $id)?>Hora" value="<?=$this->value?>" />
    </div>
</div>

<?php
Plugins_Jquery::getInputMask();
?>
<script type="text/javascript">
$("#<?=$id?>Hora").mask("99:99");
</script>