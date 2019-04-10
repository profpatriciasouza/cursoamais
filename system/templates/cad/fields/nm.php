<?php
$options = $this->getOptions();
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?></label>
    <div class="controls">
        <table class="table table-striped">


            <?php
            foreach ($options as $option) {
                $id = rand(0, 9999);
                ?>
                <tr>
                    <td>
                        <label for="<?= $this->fieldName . $id ?>">
                            <input name="<?= $this->fieldName ?>[]" id="<?= $this->fieldName . $id ?>" type="checkbox" value="<?= $option->cod ?>" 
                                   <?= isset($this->value[$option->cod]) ? "checked" : "" ?>>

                            <?= $option->desc; ?>
                        </label>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>