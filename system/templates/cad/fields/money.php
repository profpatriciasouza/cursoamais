<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
Plugins_Jquery::getMaskMoney();
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <input type="text"  name="<?= $this->fieldName ?>" id="<?= $id ?>" value="<?= $this->value; ?>" placeholder="<?= $this->Placeholder ?>">
    </div>
</div>
<script type="text/javascript">
    $("#<?= $id ?>").maskMoney();
</script>

<?php
include(dirname(__FILE__)."/pos_render.php");
?>