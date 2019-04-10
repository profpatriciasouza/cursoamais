<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <input type="radio" 
               name="<?= $this->fieldName ?>" style="float: left; width: auto;" 
               id="<?= $id ?>s" value="1"
               oldval="<?=$this->value?>"
                 <?= $this->value=="Sim" ? "checked" : "" ?> />
        <label for="<?= $id ?>s" style="width: auto; float: left; margin-left: 5px; "   >Sim</label>
        <input type="radio" 
               name="<?= $this->fieldName ?>" 
               style="float: left; margin-left: 15px; width: auto;"  id="<?= $id ?>n" value="0" <?= $this->value=="Não" ? "checked" : "" ?> />
        <label for="<?= $id ?>n" style="width: auto; float: left; margin-left: 5px; ">Não</label>
    </div>
</div>