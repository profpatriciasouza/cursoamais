<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <input type="password"  name="<?= $this->fieldName ?>" id="<?= $id ?>" value="<?= $this->value ?>" placeholder="<?= $this->Placeholder ?>">
    </div>
</div>