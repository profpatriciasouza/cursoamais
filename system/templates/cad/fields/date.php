<?php
$id = preg_replace("/[^0-9a-zA-Z_]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <input type="text"  name="<?= $this->fieldName ?>" id="<?= $id ?>" value="<?= $this->value=="" ? "" : $this->value ?>">
    </div>
    <?php
    if ($this->haveAuxButton) {
        ?>
        <div class="buttonAux">
            <input type="button" id="<?= $this->id ?>Aux" value="Adicionar">
        </div>
        <?php
    }
    ?>
</div>

<?php
Plugins_Jquery::getDataPicker();
Plugins_Jquery::getInputMask();
?>
<script type="text/javascript">
    $("#<?= $id ?>").datepicker({ dateFormat: "dd/mm/yy" });
    $("#<?= $id ?>").mask("99/99/9999", {
        completed: function() {
            <?php echo $this->maskCompleted;  ?>
        }
    });
</script>