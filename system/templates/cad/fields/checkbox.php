<?php
$options = $this->getOptions();
?>
<div class="f f<?=$this->id?>">
    <? if(!empty($this->Label)) { ?><label><?= $this->Label; ?>:</label><? } ?>
    <?php
    foreach ($options as $option) {
        ?>
        <label class="widthAuto">
            <input type="checkbox" name="<?= $this->fieldName ?>[<?= $option->cod ?>]" value="<?= $option->cod ?>" <?= isset($this->value[$option->cod]) || (!is_array($this->value) && $option->checked) ? "checked" : "" ?> />
            <?= $option->desc; ?>
        </label>
        <?php
    }
    ?>
</div>