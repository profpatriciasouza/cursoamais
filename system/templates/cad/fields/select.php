<?php
$options = $this->getOptions();
$widthSelect = "";
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls i<?=preg_replace("/[^0-9a-zA-Z]/", "", $this->id)?>">
        <input type="hidden" id="val_<?=$this->fieldName?>" value="<?=$this->value?>" />
        <select 
            onchange="<?=$this->onChange?>" 
            id="<?=$this->fieldName?>" 
            name="<?=$this->fieldName?>" 
            class="<?=preg_replace("/[^0-9a-zA-Z]/", "", $this->id)?>" <?=$widthSelect?>>
            <?php
            foreach($options as $option){
                ?>
            <option value="<?=$option->cod?>" <?=$this->is_set("value") && $option->cod==$this->value ? "selected" : ""?>><?=$option->desc; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>