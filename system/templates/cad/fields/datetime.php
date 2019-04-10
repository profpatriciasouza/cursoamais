<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="f">
    <label><?=$this->Label; ?>:</label>
    <div class="input data">
        <input type="text" name="<?=$this->fieldName?>" id="<?=$id?>" value="<?=$this->value?>" />
    </div>
    <div class="input hora">
        <input type="text" name="<?=preg_replace("/[^0-9A-Za-z]/", "", $this->fieldName)?>Hora<?=preg_match("/\[/", $this->fieldName) ? "[]" : ""?>" id="<?=preg_replace("/[^0-9A-Za-z]/", "", $id)?>Hora" value="<?=$this->valueHora?>" />
    </div>
</div>

<?php
Plugins_Jquery::getDataPicker();
Plugins_Jquery::getInputMask();
?>
<script type="text/javascript">
$("#<?=$id?>").datepicker({ dateFormat: "dd/mm/yy" });
$("#<?=$id?>Hora").mask("99:99");
</script>