<form id="<?php echo $this->id; ?>" role="form" method="<?php echo $this->method; ?>" action="<?php echo $this->action?>" <?php echo $this->getAttributes(); ?>>
    <?php
    foreach($this->getChilds() as $child) {
        $child->build();
    }
    ?>

</form>
<?php
$this->loadAssets("css");
$this->loadAssets("js");