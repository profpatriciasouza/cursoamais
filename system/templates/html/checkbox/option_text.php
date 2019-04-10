<label  class="radio-inline">
    <input type="checkbox"  name="<?php echo $this->name; ?>[]" value="<?php echo $this->value; ?>" <?php echo $this->getAttributes(); ?> > <?php echo $this->content; ?>
    <input type="text"  name="Text<?php echo $this->name; ?>" placeholder="<?php echo $this->placeholder; ?>" <?php echo $this->getAttributes(); ?> >
</label>