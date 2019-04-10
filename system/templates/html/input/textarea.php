<div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>">
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
    <textarea class="form-control" name="<?php echo $this->name; ?>" <?php echo $this->getAttributes(array("class", "class")); ?> placeholder="<?php echo $this->placeholder; ?>"><?php echo $this->value; ?></textarea>
    <div class="msg require"><?php echo $this->msgRequire; ?></div>
    <div class="msg require-email"><?php echo $this->msgEmail; ?></div>
    <?php
    Hook::exec('pos_html_input', $this);
    ?>
</div>