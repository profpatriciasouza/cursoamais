<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <textarea <?=$this->is_set("attr") ? $this->attr : ""?> rows="<?=$this->is_set("rows") ? $this->rows : "6"?>" cols="<?=$this->is_set("cols") ? $this->cols : "60"?>"  name="<?= $this->fieldName ?>" id="<?=$id ?>"><?= strip_tags($this->value); ?></textarea>
    </div>
</div>