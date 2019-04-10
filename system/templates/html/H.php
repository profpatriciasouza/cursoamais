<h<?php echo $this->level; ?> class="<?php echo $this->class ?>" <?php 
        /*
         * Imprime propedades extras do objeto, caso tenham sido especificadas
         */
        echo $this->getAttributes(array("class")); ?> ><?php echo $this->conteudo ?></h<?php echo $this->level; ?>>