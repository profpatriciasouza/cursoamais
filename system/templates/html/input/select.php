<div id="<?php echo $this->id ?>" class="form-group">
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
    <select class="form-control <?php echo $this->class; ?>" name="<?php echo $this->name; ?>">
    </select>
    <?php
    Hook::exec('pos_html_input', $this);
    ?>
</div>