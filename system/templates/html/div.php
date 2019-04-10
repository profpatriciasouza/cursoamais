<div id="<?php echo $this->id; ?>" <?php echo $this->getAttributes(array("conteudo")); ?>>
    <?php
    echo $this->conteudo;
    foreach($this->getChilds() as $child) {
        $child->build();
    }
    ?>
</div>