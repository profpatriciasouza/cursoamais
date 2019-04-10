<input 
    type="<?php echo $this->type; ?>" 
    class="form-control" 
    id="<?php echo $this->id; ?>" 
    name="<?php echo $this->name; ?>" 
    <?php
    /*
     * Imprime propedades extras do objeto, caso tenham sido especificadas
     */
    echo $this->getAttributes(array("class"));
    ?> 
    value="<?php echo $this->value; ?>" 
    placeholder="<?php echo $this->placeholder; ?>" />
