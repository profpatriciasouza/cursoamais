<a href="<?php echo $this->link?>" class="<?php echo $this->class ?>" <?php 
        /*
         * Imprime propedades extras do objeto, caso tenham sido especificadas
         */
        echo $this->getAttributes(array("class")); ?> ><?php
        if($this->icone!="") {
            ?><i class="<?php echo $this->icone?>"></i> <?php
        }
        ?><?php echo $this->ancora ?></a>