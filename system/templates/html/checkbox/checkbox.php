<?php
$this->selectValue = $this->value;
?>
<div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>" <?php if ($this->isRequired) echo "obrigatorio='sim'"; ?>>
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
        <?php
        foreach ((array) $this->options as $option) {
            echo $option->build();
        }
        ?>
    <?php
    $this->getFile("html/input/erros");
    Hook::exec('pos_html_input', $this);
    ?>
</div>