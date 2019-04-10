<div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>" <?php if($this->isRequired) echo "obrigatorio='sim'"; ?>>
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
    <input 
        type="text" 
        class="form-control" 
        name="<?php echo $this->name; ?>" 
        data-mask="99/99/9999"
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
<?php
//$this->mascara = "00/00/0000";
//$this->type = "text";
//$this->getFile("/html/input/text");

/*
<div class="col-sm-10">
                                        <input type="text" placeholder="" data-mask="99/99/9999" class="form-control">
                                        <span class="help-inline">dd/mm/yyyy</span>
                                    </div>*/
