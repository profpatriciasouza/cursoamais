<?php
$options = $this->getOptions();
?>
<div class="f">
    <label><?=$this->Label; ?>:</label>
    <div class="input">
        <select name="<?=$this->fieldName?>" id="<?=$this->id?>">
            <?php
            foreach($options as $option){
                ?>
            <option value="<?=$option->cod?>" <?=$option->cod==$this->value ? "selected" : ""?>><?=$option->desc; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>