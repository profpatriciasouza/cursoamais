<div id="<?php echo $this->id; ?>" class="panel <?php echo $this->class;?>">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $this->titulo ?></h3>
    </div>
    <div class="panel-body" load="<?php echo $this->load; ?>">
        
    </div>
    <?php if(is_object($this->footer)) $this->footer->build(); ?>
</div>