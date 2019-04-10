<div class="control-group">
    <div class="controls">
        <label class="checkbox">
            &nbsp;
        </label>
        
        <?= $this->preHTML; ?>
        <button  class="btn <?= $this->classBTN ?>"  type="submit" <?= $this->onClick != "" ? "onclick='" . $this->onClick . "'" : "" ?>><?= $this->value ?></button>
        <?= $this->posHTML; ?>
    </div>
</div>