<?php
$this->selectValue = $this->value;
?>
<div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>" <?php if($this->isRequired) echo "obrigatorio='sim'"; ?>>
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
    <select class="form-control" name="<?php echo $this->name; ?>" <?php 
        /*
         * Imprime propedades extras do objeto, caso tenham sido especificadas
         */
        echo $this->getAttributes(array("class")); ?> >
        <?php
        foreach ((array) $this->options as $option) {
            echo $option->build();
        }
        ?>
    </select>
    <?php
    $this->getFile("html/input/erros");
    Hook::exec('pos_html_input', $this);
    ?>
</div>