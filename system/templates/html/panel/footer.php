<div class="<?php echo $this->class?>">
    <a>&nbsp;</a>
    <div class="pull-right">
        <?php
        foreach ($this->childs as $child) {
            $child->build();
        }
        ?>
    </div>
</div>