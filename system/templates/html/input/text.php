<div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>" <?php if($this->isRequired) echo "obrigatorio='sim'"; ?>>
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
    <input 
        type="<?php echo $this->type; ?>" 
        class="form-control" 
        name="<?php echo $this->name; ?>" 
        <?php 
        /*
         * Imprime propedades extras do objeto, caso tenham sido especificadas
         */
        echo $this->getAttributes(array("class")); ?> 
        value="<?php echo $this->value; ?>" 
        placeholder="<?php echo $this->placeholder; ?>" />
    <?php
    $this->getFile("html/input/erros");
    ?>
    <?php
    Hook::exec('pos_html_input', $this);
    ?>
</div>