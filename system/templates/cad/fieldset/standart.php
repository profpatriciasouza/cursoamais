<fieldset class="form">
    <legend><?=$this->fieldsetDescription?></legend>
    <?php
    foreach($this->fields as $f) {
        if(!$f->showOnFieldset) continue;
        $f->build();
    }
    ?>
</fieldset>